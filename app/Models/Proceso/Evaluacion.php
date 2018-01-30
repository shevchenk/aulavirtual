<?php
namespace App\Models\Proceso;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

use DB;

class Evaluacion extends Model
{
    //protected   $table = 'v_balotarios';
    protected   $table = 'v_evaluaciones';

    public static function listarPreguntas($r)
    {
      $balotario = DB::table('v_balotarios')
                        ->where('programacion_unica_id', $r->programacion_unica_id)
                        ->where('tipo_evaluacion_id', $r->tipo_evaluacion_id)
                        ->get();

      $sql = DB::table('v_balotarios AS b')
              ->join('v_balotarios_preguntas AS bp',function($join){
                  $join->on('b.id','=','bp.balotario_id');
              })
              ->join('v_preguntas AS p',function($join){
                  $join->on('bp.pregunta_id','=','p.id');
              })
              ->join('v_respuestas AS r',function($join){
                  $join->on('p.id','=','r.pregunta_id');
              })
              ->select(
              'b.id',
              'b.programacion_unica_id',
              'b.cantidad_pregunta',
              DB::raw('p.id AS pregunta_id'),
              'p.pregunta',
              'p.imagen',
              'p.puntaje',
              DB::raw('GROUP_CONCAT(CONCAT(r.id, ":", r.respuesta) SEPARATOR "|") as alternativas')
              )
              ->where(
                  function($query) use ($r){
                      $query->where('b.estado', '=', 1);

                      if( $r->has("programacion_unica_id") ){
                          $programacion_unica_id=trim($r->programacion_unica_id);
                          if( $programacion_unica_id !='' ){
                              $query->where('b.programacion_unica_id','=', $programacion_unica_id);
                          }
                      }

                      if( $r->has("tipo_evaluacion_id") ){
                          $tipo_evaluacion_id=trim($r->tipo_evaluacion_id);
                          if( $tipo_evaluacion_id !='' ){
                              $query->where('b.tipo_evaluacion_id','=', $tipo_evaluacion_id);
                          }
                      }
                  }
              )
              ->groupBy('b.id', 'p.id','b.programacion_unica_id','b.cantidad_pregunta','p.pregunta', 'p.imagen',
              'p.puntaje')
              ->inRandomOrder()
              ->limit($balotario[0]->cantidad_pregunta)
              ->get();
        $result = $sql;
        return $result;
    }


    public static function verResultados($r)
    {
      $sql = DB::table('v_evaluaciones AS e')
              ->join('v_evaluaciones_detalle AS ed',function($join){
                  $join->on('e.id','=','ed.evaluacion_id');
              })
              ->join('v_preguntas AS p',function($join){
                  $join->on('ed.pregunta_id','=','p.id');
              })
              ->join('v_respuestas AS r',function($join){
                  $join->on('ed.respuesta_id','=','r.id');
              })
              ->select(
              'e.id',
              DB::raw('p.id AS pregunta_id'),
              'p.pregunta',
              'p.imagen',
              DB::raw('r.id AS respuesta_id'),
              'r.respuesta',
              'ed.puntaje'
              )
              ->where(
                  function($query) use ($r){
                      $query->where('ed.estado', '=', 1);
                      $query->where('e.id', '=', $r->evaluacion_id);
                  }
              )
              ->get();
        $result = $sql;
        return $result;
    }


    public static function runNew($r){

        $evaluacion = new Evaluacion;
        $evaluacion->programacion_id = trim( $r->programacion_id );
        $evaluacion->tipo_evaluacion_id = trim( $r->tipo_evaluacion_id );
        $evaluacion->fecha_evaluacion = trim( $r->fecha_evaluacion );

        //$evaluacion->estado_cambio = trim( $r->estado_cambio );
        $evaluacion->estado = 1;
        $evaluacion->persona_id_created_at=Auth::user()->id;
        $evaluacion->save();
    }

    public static function runEdit($r){

        $evaluacion = Evaluacion::find($r->id);
        $evaluacion->nota = trim( $r->nota );
        $evaluacion->estado_cambio = trim( $r->estado_cambio );
        $evaluacion->persona_id_updated_at=Auth::user()->id;
        $evaluacion->save();
    }
    
    public static function runGenerateReprogramacion($r){

        $result= Programacion::select("ve.*")
                ->join('v_evaluaciones as ve',function($join){
                    $join->on('v_programaciones.id','=','ve.programacion_id')
                    ->where('ve.estado_cambio','=',0)
                    ->where('ve.estado','=',1);
                })
                ->where(
                      function($query) use ($r){
                            if( $r->has("programacion_unica_id") ){
                                $programacion_unica_id=trim($r->programacion_unica_id);
                                if( $programacion_unica_id !='' ){
                                    $query->where('v_programaciones.programacion_unica_id','=',$programacion_unica_id);
                                }
                            }
                            if( $r->has("programacion_id") ){
                                $programacion_id=trim($r->programacion_id);
                                if( $programacion_id !='' ){
                                    $query->where('ve.programacion_id','=',$programacion_id);
                                }
                            }
                            if( $r->has("tipo_evaluacion_id") ){
                                $tipo_evaluacion_id=trim($r->tipo_evaluacion_id);
                                if( $tipo_evaluacion_id !='' ){
                                    $query->where('ve.tipo_evaluacion_id','=',$tipo_evaluacion_id);
                                }
                            }
                      }
                )->get();

        if(count($result)>0){
            foreach ($result as $data){
                $evaluacion =Evaluacion::find($data->id);
                $evaluacion->fecha_reprogramada_inicial =$r->fecha_reprogramada_inicial;
                $evaluacion->fecha_reprogramada_final =$r->fecha_reprogramada_final;
                $evaluacion->estado_cambio =3;
                $evaluacion->persona_id_updated_at=Auth::user()->id;
                $evaluacion->save();
                
                $evaluacion=new Evaluacion;
                $evaluacion->programacion_id=$data->programacion_id;
                $evaluacion->tipo_evaluacion_id=$data->tipo_evaluacion_id;
                $evaluacion->fecha_evaluacion_inicial=$r->fecha_reprogramada_inicial;
                $evaluacion->fecha_evaluacion_final=$r->fecha_reprogramada_final;
                $evaluacion->estado_cambio=0;
                $evaluacion->persona_id_created_at=Auth::user()->id;
                $evaluacion->save();
            }
            return 1;
        }else{
            return 2;
        }

    }

}

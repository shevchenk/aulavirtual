<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Mantenimiento\Pregunta;
use App\Models\Mantenimiento\BalotarioPregunta;
use DB;
class Balotario extends Model
{
    protected   $table = 'v_balotarios';

    public static function runEditStatus($r){
        
        $balotario = Balotario::find($r->id);
        $balotario->estado = trim( $r->estadof );
        $balotario->persona_id_updated_at=Auth::user()->id;
        $balotario->save();
    }

    public static function runNew($r){
        
        $balotario = new Balotario;
        $balotario->programacion_unica_id = trim( $r->programacion_unica_id );
        $balotario->tipo_evaluacion_id = trim( $r->tipo_evaluacion_id );
        $balotario->cantidad_maxima = trim( $r->cantidad_maxima );
        $balotario->cantidad_pregunta = trim( $r->cantidad_pregunta );
        $balotario->estado = trim( $r->estado );
        $balotario->persona_id_created_at=Auth::user()->id;
        $balotario->save();
    }

    public static function runEdit($r){
        
        $balotario = Balotario::find($r->id);
        $balotario->programacion_unica_id = trim( $r->programacion_unica_id );
        $balotario->tipo_evaluacion_id = trim( $r->tipo_evaluacion_id );
        $balotario->cantidad_maxima = trim( $r->cantidad_maxima );
        $balotario->cantidad_pregunta = trim( $r->cantidad_pregunta );
        $balotario->persona_id_updated_at=Auth::user()->id;
        $balotario->save();
    }


    public static function runLoad($r){
        
        $sql=Balotario::select('v_balotarios.id','vte.tipo_evaluacion','v_balotarios.cantidad_maxima','v_balotarios.cantidad_pregunta',
                'v_balotarios.estado','v_balotarios.tipo_evaluacion_id','v_balotarios.modo')
            ->join('v_tipos_evaluaciones as vte','vte.id','=','v_balotarios.tipo_evaluacion_id')
            ->where( 
                    
                function($query) use ($r){
                    if( $r->has("programacion_unica_id") ){
                        $programacion_unica_id=trim($r->programacion_unica_id);
                        if( $programacion_unica_id !='' ){
                           $query->where('v_balotarios.programacion_unica_id','=',$programacion_unica_id);
                        }
                    }
                    if( $r->has("cantidad_pregunta") ){
                        $cantidad_pregunta=trim($r->cantidad_pregunta);
                        if( $cantidad_pregunta !='' ){
                            $query->where('v_balotarios.cantidad_pregunta','like','%'.$cantidad_pregunta.'%');
                        }   
                    }
                    if( $r->has("cantidad_maxima") ){
                        $cantidad_maxima=trim($r->cantidad_maxima);
                        if( $cantidad_maxima !='' ){
                            $query->where('v_balotarios.cantidad_maxima','like','%'.$cantidad_maxima.'%');
                        }   
                    }
                    if( $r->has("tipo_evaluacion") ){
                        $tipo_evaluacion=trim($r->tipo_evaluacion);
                        if( $tipo_evaluacion !='' ){
                            $query->where('vte.tipo_evaluacion','like','%'.$tipo_evaluacion.'%');
                        }   
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('v_balotarios.estado','=',''.$estado.'');
                        }
                    }
                }
            );
        $result = $sql->orderBy('v_balotarios.id','asc')->paginate(10);
        return $result;
    }
    
    public static function runGenerateBallot($r){
            
        $balotario = Balotario::find($r->id);
        
        $result=Pregunta::select("v_preguntas.id")
            ->leftJoin('v_balotarios_preguntas as bp',function($join){
                $join->on('bp.pregunta_id','=','v_preguntas.id')
                ->where('bp.estado','=',1);
            })
            ->where('v_preguntas.estado','=',1)
            ->where('v_preguntas.tipo_evaluacion_id','=',$balotario->tipo_evaluacion_id)
//            ->whereNull('bp.pregunta_id')
            ->inRandomOrder()
            ->limit($balotario->cantidad_maxima)->get();
            
        if(count($result)>=$balotario->cantidad_maxima){
            foreach ($result as $data){
                $balotario_pregunta = new BalotarioPregunta;
                $balotario_pregunta->balotario_id =$balotario->id;
                $balotario_pregunta->pregunta_id =$data->id;
                $balotario_pregunta->estado =1;
                $balotario_pregunta->persona_id_created_at=Auth::user()->id;
                $balotario_pregunta->save();
            }
            $balotario->modo=1;
            $balotario->save();
            return 1;
        }else{
            return 2;
        }

    }
    
    public static function runHeadBallotPdf($r){
        
        $result=Balotario::select('vpu.carrera','vpu.semestre','vpu.ciclo','vc.curso',DB::raw("CONCAT_WS(' ',vp.paterno,vp.materno,vp.materno) as profesor"),
                        'vpu.fecha_inicio','vpu.fecha_final','vte.tipo_evaluacion')
            ->join('v_programaciones_unicas as vpu','vpu.id','=','v_balotarios.programacion_unica_id')
            ->join('v_cursos as vc','vc.id','=','vpu.curso_id')
            ->join('v_personas as vp','vp.id','=','vpu.persona_id')
            ->join('v_tipos_evaluaciones as vte','vte.id','=','v_balotarios.tipo_evaluacion_id')
            ->where('v_balotarios.id','=',$r->balotario_id)->get()[0];
        return $result;
    }
 
}

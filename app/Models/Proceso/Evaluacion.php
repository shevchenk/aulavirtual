<?php
namespace App\Models\Proceso;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

//use App\Models\Mantenimiento\Balotario;
use DB;

class Evaluacion extends Model
{
    protected   $table = 'v_balotarios';

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
              ->groupBy('b.id', 'p.id')
              ->inRandomOrder()
              ->limit($balotario[0]->cantidad_pregunta)
              ->get();
        $result = $sql;
        return $result;
    }

}

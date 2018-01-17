<?php
namespace App\Models\Proceso;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;

class TipoEvaluacion extends Model
{
    protected   $table = 'v_tipos_evaluaciones';

    public static function runLoad($r)
    {
        $sql=DB::table('v_tipos_evaluaciones as te')
                  ->leftJoin('v_evaluaciones AS e',function($join){
                      $join->on('te.id','=','e.tipo_evaluacion_id');
                  })
                  ->leftJoin('v_programaciones AS vp',function($join){
                      $join->on('vp.id','=','e.programacion_id');
                  })
                  ->select(
                      'te.id',
                      'te.tipo_evaluacion',
                      'te.tipo_evaluacion_externo_id',
                      'te.estado',
                      DB::raw('MAX(e.estado_cambio) AS estado_cambio'),
                      DB::raw('MAX(e.id) AS evaluacion_id')
                    )
                  ->where(
                      function($query) use ($r){
                        $query->where('te.estado','=',1);
                        
                        if( $r->has("programacion_id") ){
                            $programacion_id=trim($r->programacion_id);
                            if( $programacion_id !='' ){
                                $query->where('e.programacion_id','=', $r->programacion_id);
                            }
                        }
                        
                        if( $r->has("programacion_unica_id") ){
                            $programacion_unica_id=trim($r->programacion_unica_id);
                            if( $programacion_unica_id !='' ){
                                $query->where('vp.programacion_unica_id','=', $r->programacion_unica_id);
                            }
                        }
                        if( $r->has("estado_cambio") ){
                            $estado_cambio= explode(",",$r->estado_cambio);
                            if( $estado_cambio !='' ){
                                $query->whereIn('e.estado_cambio', $estado_cambio);
                            }
                        }
                        
                      }
                  );
//                  if($r->has("programacion_unica_id")){
                      $sql->groupBy('te.id','te.tipo_evaluacion','te.tipo_evaluacion_externo_id','te.estado');
//                  }
        $result = $sql->paginate(20);
        return $result;
    }
}

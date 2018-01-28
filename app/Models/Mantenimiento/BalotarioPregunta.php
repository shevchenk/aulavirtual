<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;


class BalotarioPregunta extends Model
{
    protected   $table = 'v_balotarios_preguntas';
    
    public static function runLoad($r){
        
        $sql=BalotarioPregunta::select('v_balotarios_preguntas.id','vp.pregunta','vr.respuesta','vp.puntaje','vp.imagen')
            ->join('v_preguntas as vp','vp.id','=','v_balotarios_preguntas.pregunta_id')
            ->join('v_respuestas as vr','vr.pregunta_id','=','vp.id')
            ->where('v_balotarios_preguntas.balotario_id','=',$r->balotario_id)
            ->where(   
                function($query) use ($r){
                    if( $r->has("programacion_unica_id") ){
                        $programacion_unica_id=trim($r->programacion_unica_id);
                        if( $programacion_unica_id !='' ){
                           $query->where('v_balotarios.programacion_unica_id','=',$programacion_unica_id);
                        }
                    }
                }
            );
        $result = $sql->orderBy('v_balotarios_preguntas.id','asc')->get();
        return $result;
    }
}

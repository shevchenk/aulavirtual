<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Respuesta extends Model
{
    protected   $table = 'v_respuestas';

    public static function runEditStatus($r)
    {
        $opcion = Respuesta::find($r->id);
        $opcion->estado = trim( $r->estadof );
        $opcion->persona_id_updated_at=Auth::user()->id;
        $opcion->save();
    }

    public static function runNew($r)
    {
        $opcion = new Respuesta;
        $opcion->pregunta_id = trim( $r->pregunta_id );
        $opcion->tipo_respuesta_id = trim( $r->tipo_respuesta_id );
        $opcion->respuesta = trim( $r->respuesta );
        $opcion->puntaje = trim( $r->puntaje );
        $opcion->estado = trim( $r->estado );
        $opcion->persona_id_created_at=Auth::user()->id;
        $opcion->save();
    }

    public static function runEdit($r)
    {
        $opcion = Respuesta::find($r->id);
        $opcion->pregunta_id = trim( $r->pregunta_id );
        $opcion->tipo_respuesta_id = trim( $r->tipo_respuesta_id );
        $opcion->respuesta = trim( $r->respuesta );
        $opcion->puntaje = trim( $r->puntaje );
        $opcion->estado = trim( $r->estado );
        $opcion->persona_id_updated_at=Auth::user()->id;
        $opcion->save();
    }


    public static function runLoad($r)
    {
        $sql=Respuesta::select('v_respuestas.id','v_respuestas.pregunta_id','v_respuestas.tipo_respuesta_id','v_respuestas.respuesta',
                'v_respuestas.puntaje','v_respuestas.estado','vp.pregunta','vtr.tipo_respuesta')
            ->join('v_preguntas as vp','vp.id','=','v_respuestas.pregunta_id')
            ->join('v_tipos_respuestas as vtr','vtr.id','=','v_respuestas.tipo_respuesta_id')
            ->where( 
                    
                function($query) use ($r){
                    if( $r->has("pregunta_id") ){
                        $pregunta_id=trim($r->pregunta_id);
                        if( $pregunta_id !='' ){
                           $query->where('v_respuestas.pregunta_id','=',$pregunta_id);
                        }
                    }
                    if( $r->has("pregunta") ){
                        $pregunta=trim($r->pregunta);
                        if( $pregunta !='' ){
                            $query->where('vp.pregunta','like','%'.$pregunta.'%');
                        }   
                    }
                    if( $r->has("tipo_respuesta") ){
                        $tipo_respuesta=trim($r->tipo_respuesta);
                        if( $tipo_respuesta !='' ){
                            $query->where('vtr.tipo_respuesta','like','%'.$tipo_respuesta.'%');
                        }   
                    }
                    if( $r->has("respuesta") ){
                        $respuesta=trim($r->respuesta);
                        if( $respuesta !='' ){
                            $query->where('v_respuestas.respuesta','like','%'.$respuesta.'%');
                        }   
                    }
                    if( $r->has("puntaje") ){
                        $puntaje=trim($r->puntaje);
                        if( $puntaje !='' ){
                            $query->where('v_respuestas.puntaje','like','%'.$puntaje.'%');
                        }   
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('v_respuestas.estado','=',''.$estado.'');
                        }
                    }
                }
            );
        $result = $sql->orderBy('v_respuestas.respuesta','asc')->paginate(10);
        return $result;
    }
    

}

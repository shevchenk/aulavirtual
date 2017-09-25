<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TipoRespuesta extends Model
{
    protected   $table = 'v_tipos_respuestas';
    
        public static function runEditStatus($r)
    {
        $tipo_respuesta = TipoRespuesta::find($r->id);
        $tipo_respuesta->estado = trim( $r->estadof );
        $tipo_respuesta->persona_id_updated_at=Auth::user()->id;
        $tipo_respuesta->save();
    }

    public static function runNew($r)
    {
        $tipo_respuesta = new TipoRespuesta;
        $tipo_respuesta->tipo_respuesta = trim( $r->tipo_respuesta );
        $tipo_respuesta->estado = trim( $r->estado );
        $tipo_respuesta->persona_id_created_at=Auth::user()->id;
        $tipo_respuesta->save();
    }

    public static function runEdit($r)
    {
        $tipo_respuesta = TipoRespuesta::find($r->id);
        $tipo_respuesta->tipo_respuesta = trim( $r->tipo_respuesta );
        $tipo_respuesta->estado = trim( $r->estado );
        $tipo_respuesta->persona_id_updated_at=Auth::user()->id;
        $tipo_respuesta->save();
    }


    public static function runLoad($r)
    {
        $sql=TipoRespuesta::select('v_tipos_respuestas.id','v_tipos_respuestas.tipo_respuesta','v_tipos_respuestas.estado')

            ->where( 
                    
                function($query) use ($r){

                    if( $r->has("tipo_respuesta") ){
                        $tipo_respuesta=trim($r->tipo_respuesta);
                        if( $tipo_respuesta !='' ){
                            $query->where('v_tipos_respuestas.tipo_respuesta','like','%'.$tipo_respuesta.'%');
                        }   
                    }
                    
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('v_tipos_respuestas.estado','=',''.$estado.'');
                        }
                    }
                }
            );
        $result = $sql->orderBy('v_tipos_respuestas.tipo_respuesta','asc')->paginate(10);
        return $result;
    }
            public static function ListTipoRespuesta($r)
    {  
        $sql= TipoRespuesta::select('id','tipo_respuesta','estado')
            ->where('estado','=','1');
        $result = $sql->orderBy('tipo_respuesta','asc')->get();
        return $result;
    }
}

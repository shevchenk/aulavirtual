<?php

namespace App\Models\Proceso;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class ContenidoRespuesta extends Model
{
    protected   $table = 'v_contenidos_respuestas';

    public static function runEditStatus($r)
    {
        
        $contenido = ContenidoRespuesta::find($r->id);
        $contenido->estado = trim( $r->estadof );
        $contenido->persona_id_updated_at=Auth::user()->id;
        $contenido->save();
    }

    public static function runNew($r)
    {
        $contenido = new ContenidoRespuesta;
        $contenido->contenido_id = trim(  $r->contenido_id );
        $contenido->programacion_id = trim( 1 );
        $contenido->respuesta = trim( $r->respuesta );
        $contenido->ruta_respuesta = trim( $r->ruta_respuesta );
        $contenido->estado = trim( $r->estado );
        $contenido->persona_id_created_at=Auth::user()->id;
        $contenido->save();
    }

    public static function runEdit($r)
    {
        $contenido = ContenidoRespuesta::find($r->id);
        $contenido->programacion_id = trim( 1 );
        $contenido->respuesta = trim( $r->respuesta );
        $contenido->ruta_respuesta = trim( $r->ruta_respuesta );
        $contenido->estado = trim( $r->estado );
        $contenido->persona_id_updated_at=Auth::user()->id;
        $contenido->save();
    }


    public static function runLoad($r)
    {
        $result=ContenidoRespuesta::select('v_contenidos_respuestas.id','v_contenidos_respuestas.programacion_id',
                'v_contenidos_respuestas.respuesta','v_contenidos_respuestas.ruta_respuesta',
                'v_contenidos_respuestas.estado')
            ->where('v_contenidos_respuestas.contenido_id','=',$r->contenido_id)
            ->orderBy('v_contenidos_respuestas.id','asc')->get();
        return $result;
    }

}

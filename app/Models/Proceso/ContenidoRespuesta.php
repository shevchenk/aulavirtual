<?php

namespace App\Models\Proceso;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class ContenidoRespuesta extends Model
{
    protected   $table = 'v_contenidos_respuestas';

    public static function runLoad($r){
        $result=ContenidoRespuesta::select('v_contenidos_respuestas.id',DB::raw("CONCAT_WS(' ',vpe.paterno,vpe.materno,vpe.nombre) as alumno"),
                'v_contenidos_respuestas.created_at','v_contenidos_respuestas.respuesta','v_contenidos_respuestas.ruta_respuesta')
            ->join('v_programaciones as vpr','vpr.id','=','v_contenidos_respuestas.programacion_id')
            ->join('v_personas as vpe','vpe.id','=','vpr.persona_id')
            ->where('v_contenidos_respuestas.contenido_id','=',$r->contenido_id)
            ->where('v_contenidos_respuestas.estado','=',1)->get();
        return $result;
    }
}

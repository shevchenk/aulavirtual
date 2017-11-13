<?php

namespace App\Models\Proceso;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class ContenidoProgramacion extends Model
{
    protected   $table = 'v_contenidos_programaciones';

    public static function runEditStatus($r){
        
        $contenido = ContenidoProgramacion::find($r->id);
        $contenido->estado = trim( $r->estadof );
        $contenido->persona_id_updated_at=Auth::user()->id;
        $contenido->save();
    }

    public static function runNew($r){
        ContenidoProgramacion::where('programacion_id','=',$r->programacion_id)
                                      ->where('contenido_id','=',$r->contenido_id)
                                        ->update(array(
                                          'estado' => 0,
                                          'persona_id_updated_at' => Auth::user()->id));
        
        $contenido = new ContenidoProgramacion;
        $contenido->contenido_id = trim(  $r->contenido_id );
        $contenido->programacion_id = trim($r->programacion_id);
        $contenido->fecha_ampliacion = trim( $r->fecha_ampliacion );
        $contenido->estado = trim( $r->estado );
        $contenido->persona_id_created_at=Auth::user()->id;
        $contenido->save();
    }

    public static function runEdit($r){
        
        $contenido = ContenidoProgramacion::find($r->id);
        $contenido->programacion_id = trim($r->programacion_id);
        $contenido->fecha_ampliacion = trim( $r->fecha_ampliacion );
        $contenido->estado = trim( $r->estado );
        $contenido->persona_id_updated_at=Auth::user()->id;
        $contenido->save();
    }


    public static function runLoad($r){
        $result=ContenidoProgramacion::select('v_contenidos_programaciones.id',DB::raw("CONCAT_WS(' ',vpe.paterno,vpe.materno,vpe.nombre) as alumno"),
                'v_contenidos_programaciones.fecha_ampliacion','v_contenidos_programaciones.estado','v_contenidos_programaciones.programacion_id')
            ->join('v_programaciones as vpr','vpr.id','=','v_contenidos_programaciones.programacion_id')
            ->join('v_personas as vpe','vpe.id','=','vpr.persona_id')
            ->where('v_contenidos_programaciones.contenido_id','=',$r->contenido_id)
            ->where('v_contenidos_programaciones.estado','=',1)
            ->orderBy('v_contenidos_programaciones.id','asc')->get();
        return $result;
    }
}

<?php

namespace App\Models\Proceso;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class Contenido extends Model
{
    protected   $table = 'v_contenidos';

    public static function runEditStatus($r)
    {
        
        $contenido = Contenido::find($r->id);
        $contenido->estado = trim( $r->estadof );
        $contenido->persona_id_updated_at=Auth::user()->id;
        $contenido->save();
    }

    public static function runNew($r)
    {
        $contenido = new Contenido;
        $contenido->programacion_unica_id = trim( $r->programacion_unica_id );
        $contenido->curso_id = trim( $r->curso_id );
        $contenido->contenido = trim( $r->contenido );
        $contenido->ruta_contenido = trim( $r->ruta_contenido );
        $contenido->tipo_respuesta = trim( $r->tipo_respuesta );
        $contenido->fecha_inicio = trim( $r->fecha_inicio );
        $contenido->fecha_final = trim( $r->fecha_final );
        $contenido->fecha_ampliada = trim( $r->fecha_ampliada );
        $contenido->estado = trim( $r->estado );
        $contenido->persona_id_created_at=Auth::user()->id;
        $contenido->save();
    }

    public static function runEdit($r)
    {
        $contenido = Contenido::find($r->id);
        $contenido->curso_id = trim( $r->curso_id );
        $contenido->contenido = trim( $r->contenido );
        $contenido->ruta_contenido = trim( $r->ruta_contenido );
        $contenido->tipo_respuesta = trim( $r->tipo_respuesta );
        $contenido->fecha_inicio = trim( $r->fecha_inicio );
        $contenido->fecha_final = trim( $r->fecha_final );
        $contenido->fecha_ampliada = trim( $r->fecha_ampliada );
        $contenido->estado = trim( $r->estado );
        $contenido->persona_id_updated_at=Auth::user()->id;
        $contenido->save();
    }


    public static function runLoad($r)
    {
        $result=Contenido::select('v_contenidos.id','v_contenidos.contenido','v_contenidos.ruta_contenido',
                'v_contenidos.tipo_respuesta','v_contenidos.fecha_inicio','v_contenidos.fecha_final',
                'v_contenidos.fecha_ampliada','vc.curso','v_contenidos.estado','v_contenidos.curso_id')
            ->join('v_cursos as vc','vc.id','=','v_contenidos.curso_id')
            ->where('v_contenidos.programacion_unica_id','=',$r->programacion_unica_id)
            ->orderBy('v_contenidos.id','asc')->get();
        return $result;
    }

}

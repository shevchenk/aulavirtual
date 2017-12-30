<?php
namespace App\Models\Proceso;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

use DB;

class EvaluacionDetalle extends Model
{
    protected   $table = 'v_evaluaciones_detalle';

    public static function runNew($r){

        $evaluacion = new EvaluacionDetalle;
        $evaluacion->evaluacion_id = trim( $r->evaluacion_id );
        $evaluacion->pregunta_id = trim( $r->pregunta_id );
        $evaluacion->respuesta_id = trim( $r->respuesta_id );
        $evaluacion->puntaje = trim( $r->puntaje );
        $evaluacion->estado = 1;
        $evaluacion->persona_id_created_at=Auth::user()->id;
        $evaluacion->save();
    }

}

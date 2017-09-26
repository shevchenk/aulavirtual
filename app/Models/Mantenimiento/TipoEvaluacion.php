<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class TipoEvaluacion extends Model
{
    protected   $table = 'v_tipos_evaluaciones';

    public static function runEditStatus($r)
    {
        $tipo_evaluacion = TipoEvaluacion::find($r->id);
        $tipo_evaluacion->estado = trim( $r->estadof );
        $tipo_evaluacion->persona_id_updated_at=Auth::user()->id;
        $tipo_evaluacion->save();
    }

    public static function runNew($r)
    {
        $tipo_evaluacion = new TipoEvaluacion;
        $tipo_evaluacion->tipo_evaluacion = trim( $r->tipo_evaluacion );
        $tipo_evaluacion->estado = trim( $r->estado );
        $tipo_evaluacion->persona_id_created_at=Auth::user()->id;
        $tipo_evaluacion->save();
    }

    public static function runEdit($r)
    {
        $tipo_evaluacion = TipoEvaluacion::find($r->id);
        $tipo_evaluacion->tipo_evaluacion = trim( $r->tipo_evaluacion );
        $tipo_evaluacion->estado = trim( $r->estado );
        $tipo_evaluacion->persona_id_updated_at=Auth::user()->id;
        $tipo_evaluacion->save();
    }


    public static function runLoad($r)
    {
        $sql=TipoEvaluacion::select('v_tipos_evaluaciones.id','v_tipos_evaluaciones.tipo_evaluacion','v_tipos_evaluaciones.estado')

            ->where(

                function($query) use ($r){

                    if( $r->has("tipo_evaluacion") ){
                        $tipo_evaluacion=trim($r->tipo_evaluacion);
                        if( $tipo_evaluacion !='' ){
                            $query->where('v_tipos_evaluaciones.tipo_evaluacion','like','%'.$tipo_evaluacion.'%');
                        }
                    }

                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('v_tipos_evaluaciones.estado','=',''.$estado.'');
                        }
                    }
                }
            );
        $result = $sql->orderBy('v_tipos_evaluaciones.tipo_evaluacion','asc')->paginate(10);
        return $result;
    }

    public static function ListTipoEvaluacion($r)
    {
        $sql=TipoEvaluacion::select('id','tipo_evaluacion','estado')
            ->where('estado','=','1');
        $result = $sql->orderBy('tipo_evaluacion','asc')->get();
        return $result;
    }
}

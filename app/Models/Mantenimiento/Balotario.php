<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Balotario extends Model
{
    protected   $table = 'v_balotarios';

    public static function runEditStatus($r)
    {
        $balotario = Balotario::find($r->id);
        $balotario->estado = trim( $r->estadof );
        $balotario->persona_id_updated_at=Auth::user()->id;
        $balotario->save();
    }

    public static function runNew($r)
    {
        $balotario = new Balotario;
        $balotario->programacion_unica_id = trim( $r->programacion_unica_id );
        $balotario->tipo_evaluacion_id = trim( $r->tipo_evaluacion_id );
        $balotario->cantidad_maxima = trim( $r->cantidad_maxima );
        $balotario->cantidad_pregunta = trim( $r->cantidad_pregunta );
        $balotario->estado = trim( $r->estado );
        $balotario->persona_id_created_at=Auth::user()->id;
        $balotario->save();
    }

    public static function runEdit($r)
    {
        $balotario = Balotario::find($r->id);
        $balotario->programacion_unica_id = trim( $r->programacion_unica_id );
        $balotario->tipo_evaluacion_id = trim( $r->tipo_evaluacion_id );
        $balotario->cantidad_maxima = trim( $r->cantidad_maxima );
        $balotario->cantidad_pregunta = trim( $r->cantidad_pregunta );
        $balotario->estado = trim( $r->estado );
        $balotario->persona_id_updated_at=Auth::user()->id;
        $balotario->save();
    }


    public static function runLoad($r)
    {
        $sql=Balotario::select('v_balotarios.id','vte.tipo_evaluacion','v_balotarios.cantidad_maxima','v_balotarios.cantidad_pregunta',
                'v_balotarios.estado','v_balotarios.tipo_evaluacion_id')
            ->join('v_tipos_evaluaciones as vte','vte.id','=','v_balotarios.tipo_evaluacion_id')
            ->where( 
                    
                function($query) use ($r){
                    if( $r->has("programacion_unica_id") ){
                        $programacion_unica_id=trim($r->programacion_unica_id);
                        if( $programacion_unica_id !='' ){
                           $query->where('v_balotarios.programacion_unica_id','=',$programacion_unica_id);
                        }
                    }
                    if( $r->has("cantidad_pregunta") ){
                        $cantidad_pregunta=trim($r->cantidad_pregunta);
                        if( $cantidad_pregunta !='' ){
                            $query->where('v_balotarios.cantidad_pregunta','like','%'.$cantidad_pregunta.'%');
                        }   
                    }
                    if( $r->has("cantidad_maxima") ){
                        $cantidad_maxima=trim($r->cantidad_maxima);
                        if( $cantidad_maxima !='' ){
                            $query->where('v_balotarios.cantidad_maxima','like','%'.$cantidad_maxima.'%');
                        }   
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('v_balotarios.estado','=',''.$estado.'');
                        }
                    }
                }
            );
        $result = $sql->orderBy('v_balotarios.id','asc')->paginate(10);
        return $result;
    }
    

}

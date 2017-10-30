<?php

namespace App\Models\Proceso;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProgramacionUnica extends Model
{
    protected   $table = 'v_programaciones_unicas';
    
    public static function runLoad($r)
    {
        $result=ProgramacionUnica::select('v_programaciones_unicas.id','v_programaciones_unicas.fecha_inicio',
                                'v_programaciones_unicas.fecha_final','vc.curso')
                                ->join('v_cursos as vc','vc.id','=','v_programaciones_unicas.curso_id')
                                ->where( 
                                    function($query) use ($r){
                                        
                                       // $query->where('vc.curso','like','%'.$curso.'%');

                                        if( $r->has("curso") ){
                                            $curso=trim($r->curso);
                                            if( $curso !='' ){
                                                $query->where('vc.curso','like','%'.$curso.'%');
                                            }   
                                        }

                                        if( $r->has("fecha_inicio") ){
                                            $fecha_inicio=trim($r->fecha_inicio);
                                            if( $fecha_inicio !='' ){
                                                $query->where('v_programaciones_unicas.fecha_inicio','like','%'.$fecha_inicio.'%');
                                            }   
                                        }
                                        
                                        if( $r->has("fecha_final") ){
                                            $fecha_final=trim($r->fecha_final);
                                            if( $fecha_final !='' ){
                                                $query->where('v_programaciones_unicas.fecha_final','like','%'.$fecha_final.'%');
                                            }   
                                        }
                                    }
                                )
                                ->orderBy('v_programaciones_unicas.id','asc')->paginate(10);
                                
        return $result;
    }

}

<?php
namespace App\Models\Proceso;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class Evaluacion extends Model
{
    protected   $table = 'v_cursos';

    public static function runLoad($r)
    {
        $sql=Evaluacion::select('v_cursos.id','v_cursos.curso','v_cursos.estado')
            ->where(
                function($query) use ($r){

                    if( $r->has("curso") ){
                        $curso=trim($r->curso);
                        if( $curso !='' ){
                            $query->where('v_cursos.curso','like','%'.$curso.'%');
                        }
                    }

                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('v_cursos.estado','=',''.$estado.'');
                        }
                    }
                }
            );
        $result = $sql->orderBy('v_cursos.curso','asc')->paginate(10);
        return $result;
    }
    
    /*
    public static function runLoad($r)
    {
        $sql=DB::table('v_programaciones as p')
            ->Join('v_programaciones_unicas AS pu', function($join){
                $join->on('p.programacion_unica_id','=','pu.id');
            })
            ->Join('v_cursos AS c', function($join){
                $join->on('p.curso_id','=','c.id');
            })
            ->Join('v_personas AS palu', function($join){
                $join->on('p.persona_id','=','palu.id');
            })
            ->Join('v_personas AS pdoc', function($join){
                $join->on('pu.persona_id','=','pdoc.id');
            })
            ->select(
            'p.id as id',
            'palu.dni',
            DB::raw("CONCAT(palu.nombre,' ', palu.paterno,' ', palu.materno) as alumno"),
            'c.curso',
            'pu.fecha_inicio',
            'pu.fecha_final',
            DB::raw("CONCAT(pdoc.nombre,' ', pdoc.paterno,' ', pdoc.materno) as docente")
            )
            ->where(
                function($query) use ($r){
                  if( $r->has("curso") ){
                      $curso=trim($r->curso);
                      if( $curso !='' ){
                          $query->where('v_cursos.curso','like','%'.$curso.'%');
                      }
                  }

                  if( $r->has("estado") ){
                      $estado=trim($r->estado);
                      if( $estado !='' ){
                          $query->where('v_cursos.estado','=',''.$estado.'');
                      }
                  }
                }
            );
        $result = $sql->orderBy('p.id','asc')->paginate(10);
        return $result;
    }
    */
}

<?php
namespace App\Models\Proceso;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;

class Curso extends Model
{
    protected   $table = 'v_cursos';

    public static function runLoad($r)
    {
        $sql=DB::table('v_programaciones as p')
            ->Join('v_programaciones_unicas AS pu', function($join){
                $join->on('p.programacion_unica_id','=','pu.id')
                     ->where('p.estado','=',1);
                
            })
            ->Join('v_cursos AS c', function($join){
                $join->on('pu.curso_id','=','c.id');
            })
            ->Join('v_personas AS palu', function($join){
                $join->on('p.persona_id','=','palu.id');
            })
            ->Join('v_personas AS pdoc', function($join){
                $join->on('pu.persona_id','=','pdoc.id');
            })
            ->select(
            'p.id',
            DB::raw('p.programacion_unica_id as pu_id'),
            DB::raw('pu.curso_id as curso_id'),
            'palu.dni',
            DB::raw("CONCAT(palu.nombre,' ', palu.paterno,' ', palu.materno) as alumno"),
            'c.curso','c.foto','c.ciclo','c.carrera','c.foto_cab',
            DB::raw('DATE(pu.fecha_inicio) as fecha_inicio'),
            DB::raw('DATE(pu.fecha_final) as fecha_final'),
            DB::raw("CONCAT(pdoc.nombre,' ', pdoc.paterno,' ', pdoc.materno) as docente")
            )
            ->where(
                function($query) use ($r){
                  $query->where('p.estado','=',1);

                  if( $r->has("dni") ){
                      $dni=trim($r->dni);
                      if( $dni !='' ){
                          $query->where('palu.dni','=', $dni);
                      }
                  }

                  if( $r->has("alumno") ){
                      $alumno=trim($r->alumno);
                      if( $alumno !='' ){
                          $query->where("CONCAT(palu.nombre,' ', palu.paterno,' ', palu.materno)",'like','%'.$alumno.'%');
                      }
                  }

                  if( $r->has("curso") ){
                      $curso=trim($r->curso);
                      if( $curso !='' ){
                          $query->where('c.curso','like','%'.$curso.'%');
                      }
                  }

                  if( $r->has("docente") ){
                      $docente=trim($r->docente);
                      if( $docente !='' ){
                          $query->where("CONCAT(pdoc.nombre,' ', pdoc.paterno,' ', pdoc.materno)",'like','%'.$docente.'%');
                      }
                  }

                  if( $r->has("fecha_inicio") ){
                      $fecha_inicio=trim($r->fecha_inicio);
                      if( $fecha_inicio !='' ){
                          $query->where('pu.fecha_inicio','like','%'.$fecha_inicio.'%');
                      }
                  }

                  if( $r->has("fecha_final") ){
                      $fecha_final=trim($r->fecha_final);
                      if( $fecha_final !='' ){
                          $query->where('pu.fecha_final','like','%'.$fecha_final.'%');
                      }
                  }

                  /*
                  if( $r->has("estado") ){
                      $estado=trim($r->estado);
                      if( $estado !='' ){
                          $query->where('p.estado','=',$estado);
                      }
                  }
                  */
                }
            );
        $result = $sql->orderBy('p.id','asc')->paginate(10);
        return $result;
    }

}

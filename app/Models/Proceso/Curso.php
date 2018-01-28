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
            ->leftJoin('v_evaluaciones AS e', function($join){
                $join->on('e.programacion_id','=','p.id')
                ->where('e.estado','=',1)
                ->where('e.estado_cambio','<',2);
            })
            ->leftJoin('v_tipos_evaluaciones AS te', function($join){
                $join->on('te.id','=','e.tipo_evaluacion_id');
            })
            ->select(
            'p.id',
            DB::raw('p.programacion_unica_id as pu_id'),
            DB::raw('pu.curso_id as curso_id'),
            'palu.dni',
            DB::raw("CONCAT(palu.nombre,' ', palu.paterno,' ', palu.materno) as alumno"),
            'c.curso','c.foto','pu.ciclo','pu.carrera','pu.semestre','c.foto_cab',
            DB::raw('DATE(pu.fecha_inicio) as fecha_inicio'),
            DB::raw('DATE(pu.fecha_final) as fecha_final'),
            DB::raw("CONCAT(pdoc.nombre,' ', pdoc.paterno,' ', pdoc.materno) as docente"),
            DB::raw("IFNULL(GROUP_CONCAT( CONCAT(te.tipo_evaluacion,' => ',e.nota) SEPARATOR '<br>' ), '') evals")
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
                  if( $r->has("semestre") ){
                      $semestre=trim($r->semestre);
                      if( $semestre !='' ){
                          $query->where('pu.semestre','like','%'.$semestre.'%');
                      }
                  }
                  if( $r->has("ciclo") ){
                      $ciclo=trim($r->ciclo);
                      if( $ciclo !='' ){
                          $query->where('pu.ciclo','like','%'.$ciclo.'%');
                      }
                  }
                  if( $r->has("carrera") ){
                      $carrera=trim($r->carrera);
                      if( $carrera !='' ){
                          $query->where('pu.carrera','like','%'.$carrera.'%');
                      }
                  }
                }
            )->groupBy('p.id', 'p.programacion_unica_id', 'pu.curso_id', 'palu.dni', 'palu.nombre', 'palu.paterno', 
                        'palu.materno', 'c.curso', 'c.foto', 'pu.ciclo', 'pu.carrera', 'pu.semestre', 'c.foto_cab',
                        'pu.fecha_inicio', 'pu.fecha_final', 'pdoc.nombre', 'pdoc.paterno', 'pdoc.materno');
        
        $result = $sql->orderBy('p.id','asc')->paginate(10);
        return $result;
    }

}

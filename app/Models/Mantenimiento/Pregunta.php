<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Pregunta extends Model
{
    protected   $table = 'v_preguntas';

    public static function runEditStatus($r)
    {
        $opcion = Pregunta::find($r->id);
        $opcion->estado = trim( $r->estadof );
        $opcion->persona_id_updated_at=Auth::user()->id;
        $opcion->save();
    }

    public static function runNew($r)
    {
        $opcion = new Pregunta;
        $opcion->curso_id = trim( $r->curso_id );
        $opcion->tipo_evaluacion_id = trim( $r->tipo_evaluacion_id );
        $opcion->pregunta = trim( $r->pregunta );
        $opcion->puntaje = trim( $r->puntaje );
        $opcion->estado = trim( $r->estado );
        $opcion->persona_id_created_at=Auth::user()->id;
        $opcion->save();
    }

    public static function runEdit($r)
    {
        $opcion = Pregunta::find($r->id);
        $opcion->curso_id = trim( $r->curso_id );
        $opcion->tipo_evaluacion_id = trim( $r->tipo_evaluacion_id );
        $opcion->pregunta = trim( $r->pregunta );
        $opcion->puntaje = trim( $r->puntaje );
        $opcion->estado = trim( $r->estado );
        $opcion->persona_id_updated_at=Auth::user()->id;
        $opcion->save();
    }


    public static function runLoad($r)
    {
        $sql = Pregunta::select('v_preguntas.id','v_preguntas.curso_id','v_preguntas.tipo_evaluacion_id','v_preguntas.pregunta',
                                'v_preguntas.puntaje','v_preguntas.estado','vc.curso','vte.tipo_evaluacion')
                          ->join('v_cursos as vc','vc.id','=','v_preguntas.curso_id')
                          ->join('v_tipos_evaluaciones as vte','vte.id','=','v_preguntas.tipo_evaluacion_id')
                          ->where(
                              function($query) use ($r){
                                  if( $r->has("curso") ){
                                      $curso=trim($r->curso);
                                      if( $curso !='' ){
                                          $query->where('vc.curso','like','%'.$curso.'%');
                                      }
                                  }
                                  if( $r->has("tipo_evaluacion") ){
                                      $tipo_evaluacion=trim($r->tipo_evaluacion);
                                      if( $tipo_evaluacion !='' ){
                                          $query->where('vte.tipo_evaluacion','like','%'.$tipo_evaluacion.'%');
                                      }
                                  }
                                  if( $r->has("pregunta") ){
                                      $pregunta=trim($r->pregunta);
                                      if( $pregunta !='' ){
                                          $query->where('v_preguntas.pregunta','like','%'.$pregunta.'%');
                                      }
                                  }
                                  if( $r->has("puntaje") ){
                                      $puntaje=trim($r->puntaje);
                                      if( $puntaje !='' ){
                                          $query->where('v_preguntas.puntaje','like','%'.$puntaje.'%');
                                      }
                                  }
                                  if( $r->has("estado") ){
                                      $estado=trim($r->estado);
                                      if( $estado !='' ){
                                          $query->where('v_preguntas.estado','=',''.$estado.'');
                                      }
                                  }
                              }
                          );
        $result = $sql->orderBy('v_preguntas.id','asc')->paginate(10);
        return $result;
    }

    public static function ListPregunta($r)
    {
        $sql=Pregunta::select('id','pregunta','estado')
            ->where('estado','=','1');
        $result = $sql->orderBy('pregunta','asc')->get();
        return $result;
    }
}

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
        $opcion->unidad_contenido_id = trim( $r->unidad_contenido_id );
        $opcion->pregunta = trim( $r->pregunta );
        $opcion->puntaje =1;
        if(trim($r->imagen_nombre)!=''){
            $opcion->imagen=$r->imagen_nombre;
        }else {
            $opcion->imagen=null;    
        }
        if(trim($r->imagen_archivo)!=''){
            $este = new Pregunta;
            $url = "img/question/".$r->imagen_nombre; 
            $este->fileToFile($r->imagen_archivo, $url);
        }
        $opcion->estado = trim( $r->estado );
        $opcion->persona_id_created_at=Auth::user()->id;
        $opcion->save();
    }

    public static function runEdit($r)
    {
        $opcion = Pregunta::find($r->id);
        $opcion->curso_id = trim( $r->curso_id );
        $opcion->unidad_contenido_id = trim( $r->unidad_contenido_id );
        $opcion->pregunta = trim( $r->pregunta );
        $opcion->puntaje =1;
        if(trim($r->imagen_nombre)!=''){
            $opcion->imagen=$r->imagen_nombre;
        }else {
            $opcion->imagen=null;    
        }
        if(trim($r->imagen_archivo)!=''){
            $este = new Pregunta;
            $url = "img/question/".$r->imagen_nombre; 
            $este->fileToFile($r->imagen_archivo, $url);
        }
        $opcion->estado = trim( $r->estado );
        $opcion->persona_id_updated_at=Auth::user()->id;
        $opcion->save();
    }


    public static function runLoad($r)
    {
        $sql = Pregunta::select('v_preguntas.id','v_preguntas.curso_id','v_preguntas.unidad_contenido_id','v_preguntas.pregunta',
                                'v_preguntas.puntaje','v_preguntas.estado','vc.curso','vuc.unidad_contenido','v_preguntas.imagen')
                          ->join('v_cursos as vc','vc.id','=','v_preguntas.curso_id')
                          ->join('v_unidades_contenido as vuc','vuc.id','=','v_preguntas.unidad_contenido_id')
                          ->where(
                              function($query) use ($r){
                                  if( $r->has("curso_id") ){
                                      $curso_id=trim($r->curso_id);
                                      if( $curso_id !='' ){
                                          $query->where('v_preguntas.curso_id','=',$curso_id);
                                      }
                                  }
                                  if( $r->has("curso") ){
                                      $curso=trim($r->curso);
                                      if( $curso !='' ){
                                          $query->where('vc.curso','like','%'.$curso.'%');
                                      }
                                  }
                                  if( $r->has("unidad_contenido") ){
                                      $unidad_contenido=trim($r->unidad_contenido);
                                      if( $unidad_contenido !='' ){
                                          $query->where('vuc.unidad_contenido','like','%'.$unidad_contenido.'%');
                                      }
                                  }
                                  if( $r->has("pregunta") ){
                                      $pregunta=trim($r->pregunta);
                                      if( $pregunta !='' ){
                                          $query->where('v_preguntas.pregunta','like','%'.$pregunta.'%');
                                      }
                                  }
                                  if( $r->has("puntaje") ){
                                      $puntaje=trim(1);
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
    
    public function fileToFile($file, $url){
        if ( !is_dir('img') ) {
            mkdir('img',0777);
        }
        if ( !is_dir('img/question') ) {
            mkdir('img/question',0777);
        }
        
        list($type, $file) = explode(';', $file);
        list(, $type) = explode('/', $type);
        if ($type=='jpeg') $type='jpg';
        if (strpos($type,'document')!==False) $type='docx';
        if (strpos($type, 'sheet') !== False) $type='xlsx';
        if (strpos($type, 'pdf') !== False) $type='pdf';
        if ($type=='plain') $type='txt';
        list(, $file)      = explode(',', $file);
        $file = base64_decode($file);
        file_put_contents($url , $file);
        return $url. $type;
    }
}

<?php

namespace App\Models\Proceso;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class Contenido extends Model
{
    protected   $table = 'v_contenidos';

    public static function runEditStatus($r){

        $contenido = Contenido::find($r->id);
        $contenido->estado = trim( $r->estadof );
        $contenido->persona_id_updated_at=Auth::user()->id;
        $contenido->save();
    }

    public static function runNew($r){

        $contenido = new Contenido;
        $contenido->programacion_unica_id = trim( $r->programacion_unica_id );
        $contenido->curso_id = trim( $r->curso_id );
        $contenido->contenido = trim( $r->contenido );
        if(trim($r->file_nombre)!='' and trim($r->file_archivo)!=''){
            $contenido->ruta_contenido = trim( $r->file_nombre );
            $url = "file/content/".$r->file_nombre;
            $ftf=new Contenido;
            $ftf->fileToFile($r->file_archivo, $url);
        }
        $contenido->tipo_respuesta = trim( $r->tipo_respuesta );
        if($r->tipo_respuesta==1){
            $contenido->fecha_inicio = trim( $r->fecha_inicio );
            $contenido->fecha_final = trim( $r->fecha_final );
            $contenido->fecha_ampliada = trim( $r->fecha_ampliada );
        }else{
            $contenido->fecha_inicio = null;
            $contenido->fecha_final = null;
            $contenido->fecha_ampliada = null;
        }
        if($r->referencia!=''){
            $contenido->referencia= implode('|', $r->referencia);
        }
        $contenido->estado = trim( $r->estado );
        $contenido->persona_id_created_at=Auth::user()->id;
        $contenido->save();
    }

    public static function runEdit($r){

        $contenido = Contenido::find($r->id);
        $contenido->contenido = trim( $r->contenido );
        if(trim($r->file_nombre)!='' and trim($r->file_archivo)!=''){
            $contenido->ruta_contenido = trim( $r->file_nombre );
            $url = "file/content/".$r->file_nombre;
            $ftf=new Contenido;
            $ftf->fileToFile($r->file_archivo, $url);
        }
        $contenido->tipo_respuesta = trim( $r->tipo_respuesta );
        if($r->tipo_respuesta==1){
            $contenido->fecha_inicio = trim( $r->fecha_inicio );
            $contenido->fecha_final = trim( $r->fecha_final );
            $contenido->fecha_ampliada = trim( $r->fecha_ampliada );
        }else{
            $contenido->fecha_inicio = null;
            $contenido->fecha_final = null;
            $contenido->fecha_ampliada = null;
        }
        if($r->referencia!=''){
            $contenido->referencia= implode('|', $r->referencia);
        }
        $contenido->estado = trim( $r->estado );
        $contenido->persona_id_updated_at=Auth::user()->id;
        $contenido->save();
    }


    public static function runLoad($r){
        $result=Contenido::select('v_contenidos.id','v_contenidos.contenido',DB::raw('IFNULL(v_contenidos.referencia,"") as referencia'),'v_contenidos.ruta_contenido',
                'v_contenidos.tipo_respuesta',DB::raw('IFNULL(v_contenidos.fecha_inicio,"") as fecha_inicio'),
                DB::raw('IFNULL(v_contenidos.fecha_final,"") as fecha_final'),
                DB::raw('IFNULL(v_contenidos.fecha_ampliada,"") as fecha_ampliada'),
                'vc.curso', 'vc.foto','v_contenidos.estado','v_contenidos.curso_id','v_contenidos.programacion_unica_id',
                DB::raw('CASE v_contenidos.tipo_respuesta  WHEN 0 THEN "Solo vista" WHEN 1 THEN "Requiere Respuesta" END AS tipo_respuesta_nombre'))
                ->join('v_cursos as vc','vc.id','=','v_contenidos.curso_id')
                ->where(
                    function($query) use ($r){
                      $query->where('v_contenidos.estado','=',1);

                      if( $r->has("programacion_unica_id") ){
                          $programacion_unica_id=trim($r->programacion_unica_id);
                          if( $programacion_unica_id !='' ){
                              $query->where('v_contenidos.programacion_unica_id','=', $programacion_unica_id);
                          }
                      }
                      
                      if( $r->has("tipo_respuesta") ){
                          $tipo_respuesta=trim($r->tipo_respuesta);
                          if( $tipo_respuesta !='' ){
                              $query->where('v_contenidos.tipo_respuesta','=', $tipo_respuesta);
                          }
                      }
                      
                      if( $r->has("curso_id") ){
                          $curso_id=trim($r->curso_id);
                          if( $curso_id !='' ){
                              $query->where('v_contenidos.curso_id','=', $curso_id);
                          }
                      }
                    }
                )
            ->orderBy('v_contenidos.id','asc')->get();
        return $result;
    }

    public function fileToFile($file, $url){
        if ( !is_dir('file') ) {
            mkdir('file',0777);
        }
        if ( !is_dir('file/content') ) {
            mkdir('file/content',0777);
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

    // --
    public static function runLoadContenidoProgra($r){
        $result=Contenido::select('v_contenidos.id','v_contenidos.contenido','v_contenidos.ruta_contenido',
                'v_contenidos.referencia',
                'v_contenidos.tipo_respuesta',DB::raw('IFNULL(v_contenidos.fecha_inicio,"") as fecha_inicio'),
                DB::raw('IFNULL(v_contenidos.fecha_final,"") as fecha_final'),
                DB::raw('IFNULL(v_contenidos.fecha_ampliada,"") as fecha_ampliada'),
                'vc.curso', 'vc.foto', 'v_contenidos.estado','v_contenidos.curso_id','v_contenidos.programacion_unica_id',
                DB::raw('CASE v_contenidos.tipo_respuesta  WHEN 0 THEN "Solo vista" WHEN 1 THEN "Requiere Respuesta" END AS tipo_respuesta_nombre'))
            ->join('v_cursos as vc','vc.id','=','v_contenidos.curso_id')
            ->where('v_contenidos.programacion_unica_id','=',$r->programacion_unica_id)
            ->where('v_contenidos.estado','=',1)
            ->orderBy('v_contenidos.id','asc')->get();
        return $result;
    }
    // --
        public static function runNewCopiaContenido($r){

        $id= implode(',', $r->id);
//        var_dump($id);Exit();
        $data=Contenido::whereRaw('id IN ('.$id.')')->get();
        foreach ($data as $result){
            $contenido = new Contenido;
            $contenido->programacion_unica_id = trim( $r->programacion_unica_id );
            $contenido->curso_id = trim( $result->curso_id );
            $contenido->contenido = trim( $result->contenido );
            if(trim($r->file_nombre)!='' and trim($r->file_archivo)!=''){
                $contenido->ruta_contenido = trim( $r->file_nombre );
                $url = "file/content/".$r->file_nombre;
                $ftf=new Contenido;
                $ftf->fileToFile($r->file_archivo, $url);
            }
            $contenido->tipo_respuesta = trim( $result->tipo_respuesta );
            if($r->tipo_respuesta==1){
            $contenido->fecha_inicio = trim( $result->fecha_inicio );
            $contenido->fecha_final = trim( $result->fecha_final );
            $contenido->fecha_ampliada = trim( $result->fecha_ampliada );
            }else{
            $contenido->fecha_inicio = null;
            $contenido->fecha_final = null;
            $contenido->fecha_ampliada = null;
            }
            $contenido->referencia=  $result->referencia;
            $contenido->estado = trim( $result->estado );
            $contenido->persona_id_created_at=Auth::user()->id;
            $contenido->save();
        }

        }
}
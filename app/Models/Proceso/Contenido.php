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

        // Eliminar archivo
        $dir = new Contenido();
        $dir->deleteDirectory("file/content/c$contenido->id");
        // --
    }

    private function deleteDirectory($dir)
    {
        if(!$dh = @opendir($dir)) return;
        while (false !== ($current = readdir($dh))) {
            if($current != '.' && $current != '..') {
                if (!@unlink($dir.'/'.$current))
                    deleteDirectory($dir.'/'.$current);
            }
        }
        closedir($dh);
        @rmdir($dir);
    }

    public static function runNew($r){

        $contenido = new Contenido;
        $contenido->programacion_unica_id = trim( $r->programacion_unica_id );
        $contenido->curso_id = trim( $r->curso_id );
        $contenido->contenido = trim( $r->contenido );
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
        if(trim($r->file_nombre)!='' and trim($r->file_archivo)!=''){
          $contenido->ruta_contenido = "c$contenido->id/".$r->file_nombre;
          $ftf = new Contenido;
          $url = "file/content/c$contenido->id/".$r->file_nombre;
          $ftf->fileToFile($r->file_archivo,'c'.$contenido->id, $url);
        }
        $contenido->save();

    }

    public static function runEdit($r)
    {
        $contenido = Contenido::find($r->id);
        $contenido->contenido = trim( $r->contenido );
        if(trim($r->file_nombre)!='' and trim($r->file_archivo)!=''){
            //$contenido->ruta_contenido = trim( $r->file_nombre );
            $contenido->ruta_contenido = "c$contenido->id/".$r->file_nombre;
            $ftf=new Contenido;
            $url = "file/content/c$contenido->id/".$r->file_nombre;
            $ftf->fileToFile($r->file_archivo,'c'.$contenido->id, $url);
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
                      if( $r->has("distinto_programacion_unica_id") ){
                          $programacion_unica_id=trim($r->distinto_programacion_unica_id);
                          if( $programacion_unica_id !='' ){
                              $query->where('v_contenidos.programacion_unica_id','!=', $programacion_unica_id);
                          }
                      }
                    }
                )
            ->orderBy('v_contenidos.id','asc')->get();
        return $result;
    }

    public function fileToFile($file, $id ,$url)
    {
        if ( !is_dir('file') ) {
            mkdir('file',0777);
        }
        if ( !is_dir('file/content/'.$id) ) {
            mkdir('file/content/'.$id,0777);
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

            if($r->id!=''){
                $id= implode(',', $r->id);
                $data=Contenido::whereRaw('id IN ('.$id.')')->get();
            }else{
                $data=array();
            }

            foreach ($data as $result){
                $contenido = new Contenido;
                $contenido->programacion_unica_id =$r->programacion_unica_id;
                $contenido->curso_id =$result->curso_id;
                $contenido->contenido =$result->contenido;
                $contenido->tipo_respuesta =$result->tipo_respuesta;
                if($result->fecha_inicio!=''){
                    $contenido->fecha_inicio =$result->fecha_inicio ;
                }
                if($result->fecha_final!=''){
                    $contenido->fecha_final =$result->fecha_final;
                }
                if($result->fecha_ampliada!=''){
                    $contenido->fecha_ampliada =$result->fecha_ampliada;
                }
                $contenido->referencia=  $result->referencia;
                $contenido->estado =$result->estado;
                $contenido->persona_id_created_at=Auth::user()->id;
                $contenido->save();
                
                if ( !is_dir('file/content/c'.$contenido->id) ) {
                     mkdir('file/content/c'.$contenido->id,0777);
                }
                $archivo=explode('/', $result->ruta_contenido);
                $fichero = 'file/content/'.$result->ruta_contenido;
                $nuevo_fichero = 'file/content/c'.$contenido->id.'/'.$archivo[1];
                
                copy($fichero,$nuevo_fichero);
                $contenido->ruta_contenido='c'.$contenido->id.'/'.$archivo[1];
                $contenido->save();
            }

        }

}


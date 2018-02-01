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
        $contenido->unidad_contenido_id = trim( $r->unidad_contenido_id );
        $contenido->titulo_contenido = trim( $r->titulo_contenido );
        $contenido->contenido = trim( $r->contenido );
        $contenido->tipo_respuesta = trim( $r->tipo_respuesta );
        if($r->tipo_respuesta==1 or $r->tipo_respuesta==2){
            if($r->fecha_inicio!=''){
                $contenido->fecha_inicio =$r->fecha_inicio ;
            }
            if($r->fecha_final!=''){
                $contenido->fecha_final =$r->fecha_final;
            }
            if($r->hora_inicio!=''){
                $contenido->hora_inicio =$r->hora_inicio ;
            }
            if($r->hora_final!=''){
                $contenido->hora_final =$r->hora_final;
            }
            if($r->fecha_ampliada!=''){
                $contenido->fecha_ampliada =$r->fecha_ampliada;
            }
        }else{
            $contenido->fecha_inicio = null;
            $contenido->fecha_final = null;
        }
        if($r->referencia!=''){
            $contenido->referencia= implode('|', $r->referencia);
        }else{
            $contenido->referencia=null;
        }
        if($r->fecha_inicio_d!=''){
            $contenido->fecha_inicio_d =$r->fecha_inicio_d ;
        }
        if($r->fecha_final_d!=''){
            $contenido->fecha_final_d =$r->fecha_final_d;
        }
        if($r->fecha_ampliada_d!=''){
            $contenido->fecha_ampliada_d =$r->fecha_ampliada_d;
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
        if(trim($r->imagen_nombre)!='' and trim($r->imagen_archivo)!=''){
          $contenido->foto = "c$contenido->id/".$r->imagen_nombre;
          $ftf = new Contenido;
          $url = "file/content/c$contenido->id/".$r->imagen_nombre;
          $ftf->fileToFile($r->imagen_archivo,'c'.$contenido->id, $url);
        }else{
          $contenido->foto = "default/nodisponible.png";  
        }
        $contenido->save();

    }

    public static function runEdit($r)
    {
        $contenido = Contenido::find($r->id);
        $contenido->contenido = trim( $r->contenido );
        $contenido->unidad_contenido_id = trim( $r->unidad_contenido_id );
        $contenido->titulo_contenido = trim( $r->titulo_contenido );
        if(trim($r->file_nombre)!='' and trim($r->file_archivo)!=''){
            $contenido->ruta_contenido = "c$contenido->id/".$r->file_nombre;
            $ftf=new Contenido;
            $url = "file/content/c$contenido->id/".$r->file_nombre;
            $ftf->fileToFile($r->file_archivo,'c'.$contenido->id, $url);
        }
        if(trim($r->imagen_nombre)!='' and trim($r->imagen_archivo)!=''){
          $contenido->foto = "c$contenido->id/".$r->imagen_nombre;
          $ftf = new Contenido;
          $url = "file/content/c$contenido->id/".$r->imagen_nombre;
          $ftf->fileToFile($r->imagen_archivo,'c'.$contenido->id, $url);
        }else if(trim($r->imagen_nombre)=='' and trim($r->imagen_archivo)==''){
            $contenido->foto = "default/nodisponible.png";  
        }
        $contenido->tipo_respuesta = trim( $r->tipo_respuesta );
        if($r->tipo_respuesta==1 or $r->tipo_respuesta==2){
            if($r->fecha_inicio!=''){
                $contenido->fecha_inicio =$r->fecha_inicio ;
            }
            if($r->fecha_final!=''){
                $contenido->fecha_final =$r->fecha_final;
            }
            if($r->hora_inicio!=''){
                $contenido->hora_inicio =$r->hora_inicio ;
            }
            if($r->hora_final!=''){
                $contenido->hora_final =$r->hora_final;
            }
            if($r->fecha_ampliada!=''){
                if( $r->fecha_ampliada!=$contenido->fecha_ampliada ){
                    $contenido->persona_masivo=Auth::user()->id;
                }
                $contenido->fecha_ampliada =$r->fecha_ampliada;
            }
        }else{
            $contenido->fecha_inicio = null;
            $contenido->fecha_final = null;
        }
        if($r->referencia!=''){
            $contenido->referencia= implode('|', $r->referencia);
        }else{
            $contenido->referencia=null;
        }
        if($r->fecha_inicio_d!=''){
            $contenido->fecha_inicio_d =$r->fecha_inicio_d ;
        }
        if($r->fecha_final_d!=''){
            $contenido->fecha_final_d =$r->fecha_final_d;
        }
        if($r->fecha_ampliada_d!=''){
            $contenido->fecha_ampliada_d =$r->fecha_ampliada_d;
        }
        $contenido->estado = trim( $r->estado );
        $contenido->persona_id_updated_at=Auth::user()->id;
        $contenido->save();
    }


    public static function runLoad($r){
        $result=Contenido::select('v_contenidos.id','v_contenidos.contenido',DB::raw('IFNULL(v_contenidos.referencia,"") as referencia'),'v_contenidos.ruta_contenido',
                'v_contenidos.tipo_respuesta',DB::raw('IFNULL(v_contenidos.fecha_inicio,"") as fecha_inicio'),
                DB::raw('IFNULL(v_contenidos.hora_inicio,"") as hora_inicio'),
                DB::raw('IFNULL(v_contenidos.hora_final,"") as hora_final'),'v_contenidos.unidad_contenido_id','v_contenidos.titulo_contenido',
                DB::raw('IFNULL(v_contenidos.fecha_final,"") as fecha_final'),'vuc.unidad_contenido','vuc.foto as foto_unidad',
                DB::raw('IFNULL(v_contenidos.fecha_ampliada,"") as fecha_ampliada'),'v_contenidos.foto as foto_contenido',
                'vc.curso', 'vc.foto', 'vc.foto_cab','v_contenidos.estado','v_contenidos.curso_id','v_contenidos.programacion_unica_id',
                DB::raw('CASE v_contenidos.tipo_respuesta  WHEN 0 THEN "Solo vista" WHEN 1 THEN "Requiere Respuesta" END AS tipo_respuesta_nombre'),
                DB::raw('IFNULL(v_contenidos.fecha_inicio_d,"") as fecha_inicio_d'),DB::raw('IFNULL(v_contenidos.fecha_final_d,"") as fecha_final_d'),DB::raw('IFNULL(v_contenidos.fecha_ampliada_d,"") as fecha_ampliada_d'))
                ->join('v_cursos as vc','vc.id','=','v_contenidos.curso_id')
                ->join('v_unidades_contenido as vuc','vuc.id','=','v_contenidos.unidad_contenido_id')
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
            ->orderBy('vuc.id','asc')
            ->orderBy('v_contenidos.tipo_respuesta','asc')->get();
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
                'v_contenidos.referencia','v_contenidos.titulo_contenido',
                'v_contenidos.tipo_respuesta',DB::raw('IFNULL(v_contenidos.fecha_inicio,"") as fecha_inicio'),
                DB::raw('IFNULL(v_contenidos.fecha_final,"") as fecha_final'),'vuc.unidad_contenido','vuc.foto as foto_unidad',
                DB::raw('IFNULL(v_contenidos.fecha_ampliada,"") as fecha_ampliada'),
                DB::raw('IFNULL(v_contenidos.hora_inicio,"") as hora_inicio'),
                DB::raw('IFNULL(v_contenidos.hora_final,"") as hora_final'),
                'v_contenidos.foto as foto_contenido','v_contenidos.unidad_contenido_id',
                'vc.curso', 'vc.foto', 'vc.foto_cab', 'v_contenidos.estado','v_contenidos.curso_id','v_contenidos.programacion_unica_id',
                DB::raw('CASE v_contenidos.tipo_respuesta  WHEN 0 THEN "Solo vista" WHEN 1 THEN "Requiere Respuesta" END AS tipo_respuesta_nombre'))
            ->join('v_cursos as vc','vc.id','=','v_contenidos.curso_id')
            ->join('v_unidades_contenido as vuc','vuc.id','=','v_contenidos.unidad_contenido_id')
            ->where('v_contenidos.programacion_unica_id','=',$r->programacion_unica_id)
            ->where('v_contenidos.estado','=',1)
            ->orderBy('vuc.id','asc')
            ->orderBy('v_contenidos.tipo_respuesta','asc')->get();
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
                $contenido->titulo_contenido =$result->titulo_contenido;
                $contenido->unidad_contenido_id =$result->unidad_contenido_id;
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
                $file_archivo=explode('/', $result->ruta_contenido);
                $file_fichero = 'file/content/'.$result->ruta_contenido;
                $file_nuevo_fichero = 'file/content/c'.$contenido->id.'/'.$file_archivo[1];
                
                copy($file_fichero,$file_nuevo_fichero);
                $contenido->ruta_contenido='c'.$contenido->id.'/'.$file_archivo[1];
                
                if($result->foto!='default/nodisponible.png'){
                    $archivo=explode('/', $result->foto);
                    $fichero = 'file/content/'.$result->foto;
                    $nuevo_fichero = 'file/content/c'.$contenido->id.'/'.$archivo[1];

                    copy($fichero,$nuevo_fichero);
                    $contenido->foto='c'.$contenido->id.'/'.$archivo[1]; 
                }else{
                    $contenido->foto=$result->foto; 
                }

                $contenido->save();
            }

        }

}


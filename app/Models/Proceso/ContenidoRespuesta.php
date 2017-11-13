<?php

namespace App\Models\Proceso;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class ContenidoRespuesta extends Model
{
    protected   $table = 'v_contenidos_respuestas';

    public static function runLoad($r){
        $result=ContenidoRespuesta::select('v_contenidos_respuestas.id',
                DB::raw("CONCAT_WS(' ',vpe.paterno,vpe.materno,vpe.nombre) as alumno"),
                'v_contenidos_respuestas.created_at','v_contenidos_respuestas.respuesta','v_contenidos_respuestas.ruta_respuesta')
            ->join('v_programaciones as vpr','vpr.id','=','v_contenidos_respuestas.programacion_id')
            ->join('v_personas as vpe','vpe.id','=','vpr.persona_id')
            ->where('v_contenidos_respuestas.contenido_id','=',$r->contenido_id)
            ->where('v_contenidos_respuestas.estado','=',1)->get();
        return $result;
    }

    // --
    public static function runNew($r){

        $contenido = new ContenidoRespuesta;
        $contenido->contenido_id = trim( $r->contenido_id );
        $contenido->programacion_id = trim( $r->programacion_id );
        $contenido->respuesta = trim( $r->respuesta );
        if(trim($r->file_nombre)!='' and trim($r->file_archivo)!=''){
            $contenido->ruta_respuesta = trim( $r->file_nombre );
            $url = "file/content/".$r->file_nombre;
            $ftf=new ContenidoRespuesta;
            $ftf->fileToFile($r->file_archivo, $url);
        }
        $contenido->estado = 1;
        $contenido->persona_id_created_at=Auth::user()->id;
        $contenido->save();
    }
    // --

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
}

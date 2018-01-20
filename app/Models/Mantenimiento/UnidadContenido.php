<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class UnidadContenido extends Model
{
    protected   $table = 'v_unidades_contenido';

    public static function ListUnidadContenido($r){
        $sql=UnidadContenido::select('id','unidad_contenido','estado')
            ->where('estado','=','1');
        $result = $sql->orderBy('unidad_contenido','asc')->get();
        return $result;
    }

    public static function runEditStatus($r){
        $unidad_contenido = UnidadContenido::find($r->id);
        $unidad_contenido->estado = trim( $r->estadof );
        $unidad_contenido->persona_id_updated_at=Auth::user()->id;
        $unidad_contenido->save();
    }

    public static function runNew($r){
        $unidad_contenido = new UnidadContenido;
        $unidad_contenido->unidad_contenido=$r->unidad_contenido;
        if(trim($r->imagen_nombre)!=''){
            $unidad_contenido->foto=$r->imagen_nombre;
        }else {
            $unidad_contenido->foto=null;    
        }
        if(trim($r->imagen_archivo)!=''){
            $este = new UnidadContenido;
            $url = "img/content_unit/".$r->imagen_nombre; 
            $este->fileToFile($r->imagen_archivo, $url);
        }
        $unidad_contenido->persona_id_created_at=Auth::user()->id;
        $unidad_contenido->save();
    }
    
    public static function runLoad($r){
        $result=UnidadContenido::select('v_unidades_contenido.id','v_unidades_contenido.unidad_contenido','v_unidades_contenido.foto','v_unidades_contenido.estado')
                                ->where(
                                    function($query) use ($r){
                                    
                                        if( $r->has("estado") ){
                                              $estado=trim($r->estado);
                                              if( $estado !='' ){
                                                  $query->where('v_unidades_contenido.estado','=', $estado);
                                              }
                                        }
                                        if( $r->has("unidad_contenido") ){
                                              $unidad_contenido=trim($r->unidad_contenido);
                                              if( $unidad_contenido !='' ){
                                                  $query->where('v_unidades_contenido.unidad_contenido','like','%'.$unidad_contenido.'%');
                                              }
                                        }
                                    }
                                )->paginate(10);

        return $result;
    }
    
    public static function runEdit($r){
        
        $unidad_contenido = UnidadContenido::find($r->id);
        $unidad_contenido->unidad_contenido=$r->unidad_contenido;
        if(trim($r->imagen_nombre)!=''){
            $unidad_contenido->foto=$r->imagen_nombre;
        }else {
            $unidad_contenido->foto=null;    
        }
        if(trim($r->imagen_archivo)!=''){
            $este = new UnidadContenido;
            $url = "img/content_unit/".$r->imagen_nombre; 
            $este->fileToFile($r->imagen_archivo, $url);
        }
        $unidad_contenido->persona_id_updated_at=Auth::user()->id;
        $unidad_contenido->save();
    }
    
    public function fileToFile($file, $url){
        if ( !is_dir('img') ) {
            mkdir('img',0777);
        }
        if ( !is_dir('img/content_unit') ) {
            mkdir('img/content_unit',0777);
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
    
    public static function runLoadUnidadPregunta($r){
        $result=UnidadContenido::select('v_unidades_contenido.unidad_contenido',DB::raw('COUNT(vp.id) as cant'),'v_unidades_contenido.id')
                                ->leftjoin('v_preguntas AS vp', function($join)use($r){
                                    $join->on('v_unidades_contenido.id','=','vp.unidad_contenido_id')
                                    ->where('vp.curso_id','=',$r->curso_id)
                                    ->where('vp.estado','=',1);
                                })
                                ->groupBy('v_unidades_contenido.unidad_contenido','v_unidades_contenido.id')->get();
        return $result;
    }
}

?>

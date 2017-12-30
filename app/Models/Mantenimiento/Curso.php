<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class Curso extends Model
{
    protected   $table = 'v_cursos';

    public static function ListCursos($r){
        $sql=Curso::select('id','curso','estado')
            ->where('estado','=','1');
        $result = $sql->orderBy('curso','asc')->get();
        return $result;
    }
    
    public static function runLoad($r){
        $result=Curso::select('v_cursos.id','v_cursos.curso','v_cursos.curso_externo_id','v_cursos.foto','v_cursos.foto_cab','v_cursos.estado')
                                ->where(
                                    function($query) use ($r){
                                        $query->where('v_cursos.estado','=', 1);
                                        if( $r->has("estado") ){
                                              $estado=trim($r->estado);
                                              if( $estado !='' ){
                                                  $query->where('v_cursos.estado','=', $estado);
                                              }
                                        }
                                        if( $r->has("curso") ){
                                              $curso=trim($r->curso);
                                              if( $curso !='' ){
                                                  $query->where('v_cursos.curso','like','%'.$curso.'%');
                                              }
                                        }
                                        if( $r->has("carrera") ){
                                            $carrera=trim($r->carrera);
                                            if( $carrera !='' ){
                                                $query->where('v_cursos.carrera','like','%'.$carrera.'%');
                                            }
                                        }
                                        if( $r->has("ciclo") ){
                                            $ciclo=trim($r->ciclo);
                                            if( $ciclo !='' ){
                                                $query->where('v_cursos.ciclo','like','%'.$ciclo.'%');
                                            }
                                        }
                                    }
                                )->paginate(10);

        return $result;
    }
    
    public static function runEdit($r){
        
        $curso = Curso::find($r->id);
        if(trim($r->imagen_nombre)!=''){
            $curso->foto=$r->imagen_nombre;
        }else {
            $curso->foto='';
        }
        if(trim($r->imagen_archivo)!=''){
            $este = new Curso;
            $url = "img/course/".$r->imagen_nombre; 
            $este->fileToFile($r->imagen_archivo, $url);
        }

        if(trim($r->imagen_cabecera_nombre)!=''){
            $curso->foto_cab=$r->imagen_cabecera_nombre;
        }else {
            $curso->foto_cab='';
        }
        if(trim($r->imagen_cabecera_archivo)!=''){
            $este = new Curso;
            $url = "img/course/".$r->imagen_cabecera_nombre; 
            $este->fileToFile($r->imagen_cabecera_archivo, $url);
        }
        $curso->persona_id_updated_at=Auth::user()->id;
        $curso->save();
    }
    
    public function fileToFile($file, $url){
        if ( !is_dir('img') ) {
            mkdir('img',0777);
        }
        if ( !is_dir('img/course') ) {
            mkdir('img/course',0777);
        }

        if( is_file($url) ){
            @unlink($url);
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

?>

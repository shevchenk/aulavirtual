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
        $result=Curso::select('v_cursos.id','v_cursos.curso','v_cursos.curso_externo_id','v_cursos.foto')
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
                                                  $query->where('v_cursos.curso','=', $curso);
                                              }
                                        }
                                    }
                                )->paginate(10);

        return $result;
    }
    
}

?>

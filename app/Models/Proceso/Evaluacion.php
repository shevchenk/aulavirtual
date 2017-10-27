<?php
namespace App\Models\Proceso;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class Evaluacion extends Model
{
    protected   $table = 'v_cursos';

    public static function runLoad($r)
    {
        $sql=Evaluacion::select('v_cursos.id','v_cursos.curso','v_cursos.estado')
            ->where(
                function($query) use ($r){

                    if( $r->has("curso") ){
                        $curso=trim($r->curso);
                        if( $curso !='' ){
                            $query->where('v_cursos.curso','like','%'.$curso.'%');
                        }
                    }

                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('v_cursos.estado','=',''.$estado.'');
                        }
                    }
                }
            );
        $result = $sql->orderBy('v_cursos.curso','asc')->paginate(10);
        return $result;
    }
}

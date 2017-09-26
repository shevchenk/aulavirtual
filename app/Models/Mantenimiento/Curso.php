<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class Curso extends Model
{
    protected   $table = 'v_cursos';

    public static function ListCursos($r)
    {
        $sql=Curso::select('id','curso','estado')
            ->where('estado','=','1');
        $result = $sql->orderBy('curso','asc')->get();
        return $result;
    }
}

?>

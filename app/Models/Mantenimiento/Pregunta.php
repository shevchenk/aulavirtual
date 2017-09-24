<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;


class Pregunta extends Model
{
    protected   $table = 'v_preguntas';
    
        public static function ListPregunta($r)
    {  
        $sql=Pregunta::select('id','pregunta','estado')
            ->where('estado','=','1');
        $result = $sql->orderBy('pregunta','asc')->get();
        return $result;
    }
}

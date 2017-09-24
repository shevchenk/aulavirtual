<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;


class TipoRespuesta extends Model
{
    protected   $table = 'v_tipos_respuestas';
    
            public static function ListTipoRespuesta($r)
    {  
        $sql= TipoRespuesta::select('id','tipo_respuesta','estado')
            ->where('estado','=','1');
        $result = $sql->orderBy('tipo_respuesta','asc')->get();
        return $result;
    }
}

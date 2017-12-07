<?php
namespace App\Models\Proceso;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;

class TipoEvaluacion extends Model
{
    protected   $table = 'v_tipos_evaluaciones';

    public static function runLoad($r)
    {
        $sql=DB::table('v_tipos_evaluaciones as te')
                  ->select(
                      'te.id',
                      'te.tipo_evaluacion',
                      'te.tipo_evaluacion_externo_id',
                      'te.estado'
                    )
                  ->where(
                      function($query) use ($r){
                        $query->where('te.estado','=',1);
                      }
                  );
        $result = $sql->orderBy('te.id','asc')->paginate(20);
        return $result;
    }
}

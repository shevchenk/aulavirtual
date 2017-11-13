<?php
namespace App\Models\Proceso;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;

class Programacion extends Model
{
    protected   $table = 'v_programaciones';
    
    public static function ListPersonaInProgramacion($r){
        
        $result=Programacion::select("vpe.paterno","vpe.materno","vpe.nombre","vpe.dni",'v_programaciones.id')
            ->join('v_personas as vpe','vpe.id','=','v_programaciones.persona_id')
            ->join('v_programaciones_unicas as vpu','vpu.id','=','v_programaciones.programacion_unica_id')
            ->where('vpu.id','=',$r->programacion_unica_id)
            ->where(function($query) use ($r){
                
                  if( $r->has("estado") ){
                      $estado=trim($r->estado);
                      if( $estado !='' ){
                          $query->where('v_programaciones.estado','=', $estado);
                      }
                  }
                  
                })->paginate(10);
        return $result;
    }
    
}

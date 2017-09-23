<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class Menu extends Model
{
    protected   $table = 'menus';

    public static function runEditStatus($r)
    {
        $certificadoestadoe = Auth::user()->id;
        $certificadoestado = Menu::find($r->id);
        $certificadoestado->estado = trim( $r->estadof );
        $certificadoestado->persona_id_updated_at=$certificadoestadoe;
        $certificadoestado->save();
    }

    public static function runNew($r)
    {
        $certificadoestadoe = Auth::user()->id;
        $certificadoestado = new Menu;
        $certificadoestado->menu = trim( $r->menu );
        $certificadoestado->class_icono = trim( $r->class_icono );
        $certificadoestado->estado = trim( $r->estado );
        $certificadoestado->persona_id_created_at=$certificadoestadoe;
        $certificadoestado->save();
    }

    public static function runEdit($r)
    {
        $certificadoestadoe = Auth::user()->id;
        $certificadoestado = Menu::find($r->id);
        $certificadoestado->menu = trim( $r->menu );
        $certificadoestado->class_icono = trim( $r->class_icono );
        $certificadoestado->estado = trim( $r->estado );
        $certificadoestado->persona_id_updated_at=$certificadoestadoe;
        $certificadoestado->save();
    }

    public static function runLoad($r)
    {

        $sql=Menu::select('id','menu','class_icono','estado')
            ->where( 
                function($query) use ($r){
                    if( $r->has("menu") ){
                        $menu=trim($r->menu);
                        if( $menu !='' ){
                            $query->where('menu','like','%'.$menu.'%');
                        }
                    }
                    if( $r->has("class_icono") ){
                        $class_icono=trim($r->class_icono);
                        if( $class_icono !='' ){
                            $query->where('class_icono','like','%'.$class_icono.'%');
                        }
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('estado','=',$estado);
                        }
                    }
                }
            );
        $result = $sql->orderBy('menu','asc')->paginate(10);
        return $result;
    }
    
    public static function ListMenu($r)
    {
        $sql=Menu::select('id','menu','class_icono','estado')
            ->where('estado','=','1');
        $result = $sql->orderBy('menu','asc')->get();
        return $result;
    }
    

}

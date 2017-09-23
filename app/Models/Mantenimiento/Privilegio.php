<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use DB;

class Privilegio extends Model
{
    protected   $table = 'privilegios';

    public static function runEditStatus($r)
    {
        $privilegio_id = Auth::user()->id;
        $privilegio = Privilegio::find($r->id);
        $privilegio->estado = trim( $r->estadof );
        $privilegio->persona_id_updated_at=$privilegio_id;
        $privilegio->save();
    }

    public static function runNew($r)
    {
        $privilegio_id = Auth::user()->id;
        $privilegio = new Privilegio;
        $privilegio->privilegio = trim( $r->privilegio );
        $privilegio->estado = trim( $r->estado );
        $privilegio->persona_id_created_at=$privilegio_id;
        $privilegio->save();
        $opcion = $r->opcion_id;

        //ESTO HACE QUE GRABE EN LA TABLE DETALLE LAS OPCIONES, LO QUE SE ESCOJE EN EL COMBO OPCION
        for($i=0;$i<count($opcion);$i++)
        {
            $privilegios_opciones = new PrivilegioOpcion;
            $privilegios_opciones->opcion_id = $opcion[$i];
            $privilegios_opciones->privilegio_id = $privilegio->id;
            $privilegios_opciones->persona_id_created_at = Auth::user()->id;
            $privilegios_opciones->save();
        }
    }

    public static function runEdit($r)
    {
        $privilegio_id = Auth::user()->id;
        $privilegio = Privilegio::find($r->id);
        $privilegio->privilegio = trim( $r->privilegio );
        $privilegio->estado = trim( $r->estado );
        $privilegio->persona_id_updated_at=$privilegio_id;
        $privilegio->save();
        $opcion = $r->opcion_id;

        //ESTO HACE QUE GRABE EN LA TABLE DETALLE LOS CURSOS, LO QUE SE ESCOJE EN EL COMBO CURSO
        if( count($opcion)>0 ){
            DB::table('privilegios_opciones')
            ->where('privilegio_id', '=', $privilegio->id)
            ->update(
                array(
                    'estado' => 0,
                    'persona_id_updated_at' => Auth::user()->id,
                    'updated_at' => date('Y-m-d H:i:s')
                    )
                );
        }
        for($i=0;$i<count($opcion);$i++)
        {
            $privilegios_opciones=DB::table('privilegios_opciones')
            ->where('privilegio_id', '=', $privilegio->id)
            ->where('opcion_id', '=', $opcion[$i])
            ->first();
            if( count($privilegios_opciones)==0 ){
                $privilegios_opciones = new PrivilegioOpcion;
                $privilegios_opciones->opcion_id = $opcion[$i];
                $privilegios_opciones->privilegio_id = $privilegio->id;
                $privilegios_opciones->persona_id_created_at = Auth::user()->id;
            }
            else{
                $privilegios_opciones = PrivilegioOpcion::find($privilegios_opciones->id);
                $privilegios_opciones->estado = 1;
                $privilegios_opciones->persona_id_updated_at = Auth::user()->id;
            }
            $privilegios_opciones->save();
        }
    }

    public static function runLoad($r)
    {   
        DB::statement(DB::raw('SET @@group_concat_max_len = 4294967295'));
        $sql=DB::table('privilegios AS p')
            ->leftJoin('privilegios_opciones AS po',function($join){
                $join->on('po.privilegio_id','=','p.id')
                ->where('po.estado','=',1);
            })
            ->leftJoin('opciones AS o',function($join){
                $join->on('o.id','=','po.opcion_id')
                ->where('o.estado','=',1);
            })
            ->select(
            'p.id',
            'p.privilegio',
            'p.estado',
            DB::raw('GROUP_CONCAT(CONCAT("<span><i class=|",class_icono,"|></i>"," ",o.opcion,"</span>") ORDER BY opcion) opciones'),
            DB::raw('GROUP_CONCAT(o.id) opcion_id')
            )
            ->where( 
                function($query) use ($r){
                    if( $r->has("privilegio") ){
                        $privilegio=trim($r->privilegio);
                        if( $privilegio !='' ){
                            $query->where('p.privilegio','like','%'.$privilegio.'%');
                        }
                    }

                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('p.estado','like','%'.$estado.'%');
                        }
                    }
                }
            )
            ->groupBy('p.id','p.privilegio','p.estado');
        $result = $sql->orderBy('p.privilegio','asc')->paginate(10);
        return $result;
    }
    
    public static function ListPrivilegio($r)
    {  
        $sql=Privilegio::select('id','privilegio','estado')
            ->where('estado','=','1');
        $result = $sql->orderBy('privilegio','asc')->get();
        return $result;
    }
}

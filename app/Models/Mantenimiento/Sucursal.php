<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class Sucursal extends Model
{
    protected   $table = 'sucursales';

    public static function runEditStatus($r)
    {
        $sucursale = Auth::user()->id;
        $sucursal = Sucursal::find($r->id);
        $sucursal->estado = trim( $r->estadof );
        $sucursal->persona_id_updated_at=$sucursale;
        $sucursal->save();
    }

    public static function runNew($r)
    {
        $sucursale = Auth::user()->id;
        $sucursal = new Sucursal;
        $sucursal->sucursal = trim( $r->sucursal );
        $sucursal->direccion = trim( $r->direccion );
        $sucursal->telefono = trim( $r->telefono );
        $sucursal->celular = trim( $r->celular );
        $sucursal->email = trim( $r->email );
        $sucursal->estado = trim( $r->estado );
        $sucursal->persona_id_created_at=$sucursale;
        if(trim($r->imagen_nombre)!=''){
        $sucursal->foto=$r->imagen_nombre;
        $este = new Sucursal;
        $url = "img/sucursa/".$r->imagen_nombre; 
        $este->fileToFile($r->imagen_archivo, $url);}
        else {
        $sucursal->foto=null;    
        }
        $sucursal->save();
    }

    public static function runEdit($r)
    {
        $sucursale = Auth::user()->id;
        $sucursal = Sucursal::find($r->id);
        $sucursal->sucursal = trim( $r->sucursal );
        $sucursal->direccion = trim( $r->direccion );
        $sucursal->telefono = trim( $r->telefono );
        $sucursal->celular = trim( $r->celular );
        $sucursal->email = trim( $r->email );
        $sucursal->estado = trim( $r->estado );
        $sucursal->persona_id_updated_at=$sucursale;
        if(trim($r->imagen_nombre)!=''){
            $sucursal->foto=$r->imagen_nombre;
        }else {
            $sucursal->foto=null;    
        }
        if(trim($r->imagen_archivo)!=''){
            $este = new Sucursal;
            $url = "img/sucursa/".$r->imagen_nombre; 
            $este->fileToFile($r->imagen_archivo, $url);
        }
        $sucursal->save();
    }

    public static function runLoad($r)
    {
        $sql=Sucursal::select('id','sucursal','direccion','telefono','celular','email','foto','estado')
            ->where( 
                function($query) use ($r){
                    if( $r->has("sucursal") ){
                        $sucursal=trim($r->sucursal);
                        if( $sucursal !='' ){
                            $query->where('sucursal','like','%'.$sucursal.'%');
                        }
                    }
                    if( $r->has("direccion") ){
                        $direccion=trim($r->direccion);
                        if( $direccion !='' ){
                            $query->where('direccion','like','%'.$direccion.'%');
                        }
                    }
                    if( $r->has("telefono") ){
                        $telefono=trim($r->telefono);
                        if( $telefono !='' ){
                            $query->where('telefono','like',$telefono.'%');
                        }
                    }
                    if( $r->has("celular") ){
                        $celular=trim($r->celular);
                        if( $celular !='' ){
                            $query->where('celular','like','%'.$celular.'%');
                        }
                    }
                    if( $r->has("email") ){
                        $email=trim($r->email);
                        if( $email !='' ){
                            $query->where('email','like','%'.$email.'%');
                        }
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('estado','like','%'.$estado.'%');
                        }
                    }
                }
            );
        $result = $sql->orderBy('sucursal','asc')->paginate(10);
        return $result;
    }

    public static function runLoad2($r)
    {
        $sql=Sucursal::select('id','sucursal','direccion','telefono','celular','email')->where('estado','=',1);
        $result = $sql->orderBy('sucursal','asc')->get();
        return $result;
    }

    public function fileToFile($file, $url)
    {
        if ( !is_dir('img') ) {
            mkdir('img',0777);
        }
        if ( !is_dir('img/sucursa') ) {
            mkdir('img/sucursa',0777);
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
    
    public static function ListSucursal($r)
    {
        $sql=Sucursal::select('id','sucursal','estado')
            ->where('estado','=','1');
        $result = $sql->orderBy('sucursal','asc')->get();
        return $result;
    }
    
    public static function ListSucursalandUsuario($r)
    {
        $sql= PersonaPrivilegioSucursal::select('s.id','s.sucursal','s.estado')
            ->join('sucursales as s','s.id','=','pps.sucursal_id')
            ->where('pps.estado','=','1')
            ->where('pps.persona_id','=', Auth::user()->id);
        $result = $sql->orderBy('sucursal','asc')->get();
        return $result;

    }

    // Export
    public static function runExport($r)
    {
        $rsql= Sucursal::runLoad2($r);

        $length=array(
            'A'=>15,
            'B'=>15,'C'=>40,'D'=>20,'E'=>20,
            'F'=>30
        );
        $cabecera=array(
            'id','Sucursal','Direccion','Telefono',
            'Celular','Email'
        );
        $campos=array(
            'id','sucursal','direccion','telefono',
            'celular','email'
        );

        $r['data']=$rsql;
        $r['cabecera']=$cabecera;
        $r['campos']=$campos;
        $r['length']=$length;
        $r['max']='F'; // Max. Celda en LETRA
        return $r;
    }

}

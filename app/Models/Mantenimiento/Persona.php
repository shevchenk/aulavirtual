<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class Persona extends Model
{
    protected   $table = 'v_personas';



    public static function runEditStatus($r)
    {
        $persona_id = Auth::user()->id;
        $persona = Persona::find($r->id);
        $persona->estado = trim( $r->estadof );
        $persona->persona_id_updated_at=$persona_id;
        $persona->save();
    }

    public static function runNew($r)
    {
        $persona_id = Auth::user()->id;
        $persona = new Persona;
        $persona->paterno = trim( $r->paterno );
        $persona->materno = trim( $r->materno );
        $persona->nombre = trim( $r->nombre );
        $persona->dni = trim( $r->dni );
        $persona->sexo = trim( $r->sexo );
        $persona->email = trim( $r->email );
        $bcryptpassword = bcrypt($r->password);
        $persona->password=$bcryptpassword;
        $persona->telefono = trim( $r->telefono );
        $persona->celular = trim( $r->celular );
        if(trim( $r->fecha_nacimiento )!=''){
        $persona->fecha_nacimiento = trim( $r->fecha_nacimiento );}
        else {
        $persona->fecha_nacimiento = null;
        }
        $persona->estado = trim( $r->estado );
        $persona->persona_id_created_at=$persona_id;
        $persona->save();

        if ($r->cargos_selec) {
                $cargos=$r->cargos_selec;
                $cargos = explode(',', $cargos);
                if (is_array($cargos)) {
                    for ($i=0; $i<count($cargos); $i++) {
                        $cargoId = $cargos[$i];

                         $areas = $r['areas'.$cargoId];

                        for ($j=0; $j<count($areas); $j++) {
                            //recorrer las areas y buscar si exten
                            $areaId = $areas[$j];
                            DB::table('personas_privilegios_sucursales')->insert(
                                array(
                                    'sucursal_id' => $areaId,
                                    'privilegio_id' => $cargoId,
                                    'persona_id' => $persona->id,
                                    'created_at'=> date('Y-m-d h:m:s'),
                                    'persona_id_created_at'=> Auth::user()->id,
                                    'estado' => 1,
                                    'persona_id_updated_at' => Auth::user()->id
                                )
                            );
                        }
                    }
                }
            }
    }

    public static function runEdit($r)
    {
        $persona_id = Auth::user()->id;
        $persona = Persona::find($r->id);
        $persona->paterno = trim( $r->paterno );
        $persona->materno = trim( $r->materno );
        $persona->nombre = trim( $r->nombre );
        $persona->dni = trim( $r->dni );
        $persona->sexo = trim( $r->sexo );
        $persona->email = trim( $r->email );
        if(trim( $r->password )!=''){
        $persona->password=bcrypt($r->password);}

        $persona->telefono = trim( $r->telefono );
        $persona->celular = trim( $r->celular );

        if(trim( $r->fecha_nacimiento )!='')
        {
        $persona->fecha_nacimiento = trim( $r->fecha_nacimiento );
        }
        else
        {
        $persona->fecha_nacimiento = null;
        }

        $persona->estado = trim( $r->estado );
        $persona->persona_id_updated_at=$persona_id;
        $persona->save();

        DB::table('personas_privilegios_sucursales')
                ->where('persona_id', $r->id)
                ->update(array('estado' => 0,
                    'persona_id_updated_at' => Auth::user()->id));

        $cargos = $r->cargos_selec;
         if ($cargos) {//si selecciono algun cargo
                $cargos = explode(',', $cargos);
                $areas=array();

                //recorrer os cargos y verificar si existen
                for ($i=0; $i<count($cargos); $i++) {
                    $cargoId = $cargos[$i];
                    $areas = $r['areas'.$cargoId];

                    DB::table('personas_privilegios_sucursales')
                            ->where('privilegio_id', '=', $cargoId)
                            ->where('persona_id', '=', $r->id)
                            ->update(
                                array(
                                    'estado' => 0,
                                    'persona_id_updated_at' => Auth::user()->id
                                    )
                                );

                    //almacenar las areas seleccionadas
                    for ($j=0; $j<count($areas); $j++) {
                        //recorrer las areas y buscar si exten
                        $areaId = $areas[$j];
                        $areaCargoPersona=DB::table('personas_privilegios_sucursales')
                                ->where('sucursal_id', '=', $areaId)
                                ->where('privilegio_id', $cargoId)
                                ->where('persona_id', $r->id)
                                ->first();
                        if (is_null($areaCargoPersona)) {
                            DB::table('personas_privilegios_sucursales')->insert(
                                array(
                                    'sucursal_id' => $areaId,
                                    'privilegio_id' => $cargoId,
                                    'persona_id' => $r->id,
                                    'created_at'=> date('Y-m-d h:m:s'),
                                    'persona_id_created_at'=> Auth::user()->id,
                                    'estado' => 1,
                                    'persona_id_updated_at' => Auth::user()->id
                                )
                            );
                        } else {
                            DB::table('personas_privilegios_sucursales')
                            ->where('sucursal_id', '=', $areaId)
                            ->where('privilegio_id', '=', $cargoId)
                            ->update(
                                array(
                                    'estado' => 1,
                                    'persona_id_updated_at' => Auth::user()->id
                                ));
                        }
                    }
                }
            }

    }


    public static function runLoad($r)
    {
        $sql=Persona::select('id','paterno','materno','nombre','dni',
            'email',DB::raw('IFNULL(fecha_nacimiento,"") as fecha_nacimiento'),'sexo','telefono',
            'celular','password','estado')
            ->where(
                function($query) use ($r){
                    if( $r->has("paterno") ){
                        $paterno=trim($r->paterno);
                        if( $paterno !='' ){
                            $query->where('paterno','like','%'.$paterno.'%');
                        }
                    }
                    if( $r->has("materno") ){
                        $materno=trim($r->materno);
                        if( $materno !='' ){
                            $query->where('materno','like','%'.$materno.'%');
                        }
                    }
                    if( $r->has("nombre") ){
                        $nombre=trim($r->nombre);
                        if( $nombre !='' ){
                            $query->where('nombre','like','%'.$nombre.'%');
                        }
                    }
                    if( $r->has("dni") ){
                        $dni=trim($r->dni);
                        if( $dni !='' ){
                            $query->where('dni','like','%'.$dni.'%');
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
                            $query->where('estado','=',$estado);
                        }
                    }
                }
            );
        $result = $sql->orderBy('paterno','asc')->paginate(10);
        return $result;
    }

     public static function getAreas($personaId) {
        //subconsulta
        $sql = DB::table('personas_privilegios_sucursales as cp')
                ->join(
                        'privilegios as c', 'cp.privilegio_id', '=', 'c.id'
                )
//                ->join(
//                        'area_cargo_persona as acp', 'cp.id', '=', 'acp.cargo_persona_id'
//                )
                ->join(
                        'sucursales as a', 'cp.sucursal_id', '=', 'a.id'
                )
                ->select(
                        DB::raw(
                                "
                CONCAT(c.id, '-',
                    GROUP_CONCAT(a.id)
                ) AS info"
                        )
                )
                ->whereRaw("cp.persona_id=$personaId AND cp.estado=1 AND c.estado=1 ")
                ->groupBy('c.id');
        //consulta
        $areas = DB::table(DB::raw("(" . $sql->toSql() . ") as a"))
                ->select(
                        DB::raw("GROUP_CONCAT( info SEPARATOR '|'  ) as DATA ")
                )
                ->get();

        return $areas;
    }



}

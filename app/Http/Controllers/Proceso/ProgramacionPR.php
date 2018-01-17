<?php
namespace App\Http\Controllers\Proceso;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Proceso\Programacion;
use App\Models\Proceso\ProgramacionUnica;
use App\Models\Proceso\Persona;
use App\Http\Controllers\Api\Api;
use Illuminate\Support\Facades\Auth;
use DB;

class ProgramacionPR extends Controller
{
    private $api;

    public function __construct()
    {
        $this->api = new Api();
        $this->middleware('auth');  //Esto debe activarse cuando estemos con sessión
    }

    public function ListPersonaInProgramacion(Request $r ){
        if ( $r->ajax() ) {

            $idcliente = session('idcliente');
            $param_data = array('programacion_unica_id' => $r->programacion_unica_id);

            // URL (CURL)
            $cli_links = DB::table('clientes_accesos_links')->where('cliente_acceso_id','=', $idcliente)
                                                            ->where('tipo','=', 5)
                                                            ->first();
            $objArr = $this->api->curl($cli_links->url,$param_data);

            // --
            $return_response = '';

            if (empty($objArr))
            {
                $return_response = $this->api->response(422,"error","Ingrese sus datos de envio");
            }
            else if(isset($objArr->key[0]->id) && isset($objArr->key[0]->token))
            {
                $tab_cli = DB::table('clientes_accesos')->select('id', 'nombre', 'key', 'url', 'ip')
                                                        ->where('id','=', $objArr->key[0]->id)
                                                        ->where('key','=', $objArr->key[0]->token)
                                                        ->where('ip','=', $this->api->getIPCliente())
                                                        ->where('estado','=', 1)
                                                        ->first();

                if($objArr->key[0]->id == @$tab_cli->id && $objArr->key[0]->token == @$tab_cli->key)
                {
                    $val = $this->insertarAlumno($objArr);
                    if($val['return'] == true){
                        $this->api->curl('localhost/Cliente/Retorno.php',$val['externo_id']);
                        $return_response = $this->api->response(200,"success","Proceso ejecutado satisfactoriamente");
                    }else
                        $return_response = $this->api->response(422,"error","Revisa tus parametros de envio");
                }
                else
                {
                    $return_response = $this->api->response(422 ,"error","Su Parametro de seguridad son incorrectos");
                }
            }
            else
            {
                $return_response = $this->api->response(422,"error","Revisa tus parametros de envio");
            }

            // Creación de un archivo JSON para dar respuesta al cliente
              $uploadFolder = 'txt/api';
              $nombre_archivo = "cliente.json";
              $file = $uploadFolder . '/' . $nombre_archivo;
              unlink($file);
              if($archivo = fopen($file, "a"))
              {
                fwrite($archivo, $return_response);
                fclose($archivo);
              }
            // --

            $renturnModel = Programacion::ListPersonaInProgramacion($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);
        }
    }
    
    public function ListPersonaInProgramacionMaster(Request $r ){
        if ( $r->ajax() ) {
            $programacion_unica= ProgramacionUnica::find($r->programacion_unica_id);
            $param_data = array('programacion_unica_externo_id' => $programacion_unica->programacion_unica_externo_id);

            // URL (CURL)
            $cli_links = DB::table('clientes_accesos_links')->where('cliente_acceso_id','=',1)
                                                            ->where('tipo','=', 5)
                                                            ->first();
            $objArr = $this->api->curl($cli_links->url,$param_data);

            // --
            $return_response = '';

            if (empty($objArr))
            {
                $return_response = $this->api->response(422,"error","Ingrese sus datos de envio");
            }
            else if(isset($objArr->key[0]->id) && isset($objArr->key[0]->token))
            {
                $tab_cli = DB::table('clientes_accesos')->select('id', 'nombre', 'key', 'url', 'ip')
                                                        ->where('id','=', $objArr->key[0]->id)
                                                        ->where('key','=', $objArr->key[0]->token)
                                                        ->where('ip','=', $this->api->getIPCliente())
                                                        ->where('estado','=', 1)
                                                        ->first();

                if($objArr->key[0]->id == @$tab_cli->id && $objArr->key[0]->token == @$tab_cli->key)
                {
                    $val = $this->insertarAlumno($objArr,$r);
                    if($val['return'] == true){
                        
                        $this->api->curl('localhost/Cliente/Retorno.php',$val['externo_id']);
                        $return_response = $this->api->response(200,"success","Proceso ejecutado satisfactoriamente");
                    }else
                        $return_response = $this->api->response(422,"error","Revisa tus parametros de envio");
                }
                else
                {
                    $return_response = $this->api->response(422 ,"error","Su Parametro de seguridad son incorrectos");
                }
            }
            else
            {
                $return_response = $this->api->response(422,"error","Revisa tus parametros de envio");
            }

            // Creación de un archivo JSON para dar respuesta al cliente
              $uploadFolder = 'txt/api';
              $nombre_archivo = "cliente.json";
              $file = $uploadFolder . '/' . $nombre_archivo;
              unlink($file);
              if($archivo = fopen($file, "a"))
              {
                fwrite($archivo, $return_response);
                fclose($archivo);
              }
            // --

            $renturnModel = Programacion::ListPersonaInProgramacion($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);
        }
    }
    
    public function insertarAlumno($objArr,$r){
        DB::beginTransaction();
        $array_curso='0';
        $array_programacion_unica='0';
        $array_programacion='0';
        try{

          foreach ($objArr->alumno as $k=>$value){
              // Proceso Persona Alumno
              $alumno = Persona::where('dni', '=', trim($value->alumno_dni))
                                  ->first();
              if (count($alumno) == 0){
                  $alumno = new Persona();
                  $alumno->dni = trim($value->alumno_dni);
                  $alumno->persona_id_created_at=1;
              }
              else
                  $alumno->persona_id_updated_at=1;

              $alumno->paterno = trim($value->alumno_paterno);
              $alumno->materno = trim($value->alumno_materno);
              $alumno->nombre = trim($value->alumno_nombre);
              $alumno->save();
              // --
              // Proceso Programación
              $programacion = Programacion::where('programacion_externo_id', '=', trim($value->programacion_externo_id))
                                            ->where('persona_id', '=', trim($alumno->id))
                                                      ->first();
              if (count($programacion) == 0) //Insert
              {
                  $programacion = new Programacion();
                  $programacion->programacion_externo_id = trim($value->programacion_externo_id);
                  $programacion->programacion_unica_id = $r->programacion_unica_id;
                  $programacion->persona_id = $alumno->id;
                  $programacion->persona_id_created_at=1;
              }
              else //Update
              {
                  $programacion->estado = $value->programacion_estado;
                  $programacion->persona_id_created_at=1;
              }
              $programacion->save();
              $array_programacion.=','.$programacion->programacion_externo_id;
              // --
          }

          DB::commit();
          $data['return']= true;
          $data['externo_id']=array('curso'=>$array_curso,'programacion_unica'=>$array_programacion_unica,'programacion'=>$array_programacion);
        }
        catch (\Exception $e)
        {
            DB::rollback();
            //dd($e);
            $data['return']= false;
        }
        return $data;
    }

}

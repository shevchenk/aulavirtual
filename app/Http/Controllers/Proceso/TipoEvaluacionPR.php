<?php
namespace App\Http\Controllers\Proceso;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Api\Api;
use App\Models\Proceso\TipoEvaluacion;
use App\Models\Proceso\ProgramacionUnica;
//use App\Models\Proceso\Persona;
use App\Models\Proceso\Programacion;
use App\Models\Proceso\Evaluacion;

class TipoEvaluacionPR extends Controller
{
    private $api;

    public function __construct()
    {
        $this->api = new Api();
    }

    public function index(){
        //
    }

    public function Load(Request $r )
    {
        if ( $r->ajax() ) {
            $r['dni'] = Auth::user()->dni;
            $renturnModel = TipoEvaluacion::runLoad($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);
        }
    }

    public function validarTipoEvaluacion(Request $r)
    {
        $idcliente = session('idcliente');
        $programacion = Programacion::find($r->programacion_id);
        $programacion_unica = ProgramacionUnica::find($programacion->programacion_unica_id);

        $param_data = array('dni' => Auth::user()->dni,
                              'programacion_unica_externo_id' => $programacion_unica->programacion_unica_externo_id);
        // URL (CURL)
        $cli_links = DB::table('clientes_accesos_links')->where('cliente_acceso_id','=', $idcliente)
                                                        ->where('tipo','=', 11)
                                                        ->first();
        $objArr = $this->api->curl($cli_links->url, $param_data);
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
                $val = $this->insertarTipoEvaluacion($objArr, $r);
                if($val['return'] == true)
                  $return_response = $this->api->response(200,"success","Proceso ejecutado satisfactoriamente");
                else
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
        $r['dni'] = Auth::user()->dni;
        $renturnModel = TipoEvaluacion::runLoad($r);
        //dd($renturnModel);
        $return['rst'] = 1;
        $return['data'] = $renturnModel;
        $return['msj'] = "No hay registros aún";
        return response()->json($return);
    }

    public function validarTipoEvaluacionMaster(Request $r)
    {
        $programacion_unica = ProgramacionUnica::find($r->programacion_unica_id);

        $param_data = array('dni' => Auth::user()->dni,
                              'programacion_unica_externo_id' => $programacion_unica->programacion_unica_externo_id);
        // URL (CURL)
        $cli_links = DB::table('clientes_accesos_links')->where('cliente_acceso_id','=', 1)
                                                        ->where('tipo','=', 11)
                                                        ->first();
        $objArr = $this->api->curl($cli_links->url, $param_data);
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
                $val = $this->insertarTipoEvaluacion($objArr, $r);
                if($val['return'] == true)
                  $return_response = $this->api->response(200,"success","Proceso ejecutado satisfactoriamente");
                else
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
        $r['dni'] = Auth::user()->dni;
        $renturnModel = TipoEvaluacion::runLoad($r);
        //dd($renturnModel);
        $return['rst'] = 1;
        $return['data'] = $renturnModel;
        $return['msj'] = "No hay registros aún";
        return response()->json($return);
    }

    public function insertarTipoEvaluacion($objArr, $r)
    {
        DB::beginTransaction();
        try
        {
          foreach ($objArr->tipo as $k=>$value)
          {
              $tipoeval = TipoEvaluacion::where('tipo_evaluacion', '=', trim($value->tipo_evaluacion))
                                        ->where('tipo_evaluacion_externo_id','=', trim($value->tipo_evaluacion_externo_id))
                                        ->first();
              if (count($tipoeval) == 0)
              {
                $tipoeval = TipoEvaluacion::where('tipo_evaluacion_externo_id', '=', trim($value->tipo_evaluacion_externo_id))
                                          ->first();
                if(count($tipoeval) == 0) //Insert
                {
                  $tipoeval = new TipoEvaluacion();
                  $tipoeval->tipo_evaluacion_externo_id = trim($value->tipo_evaluacion_externo_id);
                  $tipoeval->persona_id_created_at=1;
                }
                else
                  $tipoeval->persona_id_updated_at=1;

                $tipoeval->tipo_evaluacion = trim($value->tipo_evaluacion);
                $tipoeval->save();
              }

              $evaluacion = Evaluacion::where('programacion_id', '=', trim($r->programacion_id))
                                      ->where('tipo_evaluacion_id', '=', trim($tipoeval->id))
                                      ->first();

              //$r['fecha_evaluacion'] = $value->fecha_evaluacion;
              if(count($evaluacion) == 0) // Insert
              {
                $r['tipo_evaluacion_id'] = $tipoeval->id;
                //$r['estado_cambio'] = $estado_cambio;
                $evaluacion = Evaluacion::runNew($r);
              }
              else
              {
                if ($value->evaluaciones_estado == 0) {
                  $evaluacion->estado_cambio = 2;
                }
                //$evaluacion->fecha_evaluacion = $value->fecha_evaluacion;
                $evaluacion->estado = $value->evaluaciones_estado;

                $evaluacion->persona_id_updated_at=Auth::user()->id;
                $evaluacion->save();
              }
              //break;
          }

          DB::commit();
          $data['return']= true;
        }
        catch (\Exception $e)
        {
            DB::rollback();
            $data['return']= false;
        }
        return $data;
    }
}

<?php
namespace App\Http\Controllers\Proceso;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Proceso\ProgramacionUnica;
use App\Models\Proceso\Curso;
use App\Models\Proceso\Persona;
use Illuminate\Support\Facades\Auth;
use DB;

class ProgramacionUnicaPR extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  //Esto debe activarse cuando estemos con sessión
    } 

    public function Load(Request $r )
    {
        if ( $r->ajax() ) {
            $renturnModel = ProgramacionUnica::runLoad($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";    
            return response()->json($return);   
        }
    }
    
        public function response($code=200, $status="", $message="")
    {
        http_response_code($code);
        if( !empty($status) && !empty($message) )
        {
            $response = array(
                        "status" => $status ,
                        "message"=>$message,
                        "server" => $this->getIPCliente()
                    );
            //echo json_encode($response, JSON_PRETTY_PRINT);
            return json_encode($response, JSON_PRETTY_PRINT);
        }
    }


    public function validarProgramacion(Request $r)
    {
        $idcliente = session('idcliente');
        $param_data = array('dni' => Auth::user()->dni);

        // URL (CURL)
        $cli_links = DB::table('clientes_accesos_links')->where('cliente_acceso_id','=', $idcliente)
                                                        ->where('tipo','=', 3)
                                                        ->first();
        $objArr = $this->curl($cli_links->url, $param_data);
        // --
        $return_response = '';

        if (empty($objArr))
        {
            $return_response = $this->response(422,"error","Ingrese sus datos de envio");
        }
        else if(isset($objArr->key[0]->id) && isset($objArr->key[0]->token))
        {
            $tab_cli = DB::table('clientes_accesos')->select('id', 'nombre', 'key', 'url', 'ip')
                                                    ->where('id','=', $objArr->key[0]->id)
                                                    ->where('key','=', $objArr->key[0]->token)
                                                    ->where('ip','=', $this->getIPCliente())
                                                    ->where('estado','=', 1)
                                                    ->first();

            if($objArr->key[0]->id == @$tab_cli->id && $objArr->key[0]->token == @$tab_cli->key)
            {
                $val = $this->insertarEvaluacion($objArr);
                if($val == true)
                    $return_response = $this->response(200,"success","Proceso ejecutado satisfactoriamente");
                else
                    $return_response = $this->response(422,"error","Revisa tus parametros de envio");
            }
            else
            {
                $return_response = $this->response(422 ,"error","Su Parametro de seguridad son incorrectos");
            }
        }
        else
        {
            $return_response = $this->response(422,"error","Revisa tus parametros de envio");
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
        $renturnModel = ProgramacionUnica::runLoad($r);
        $return['rst'] = 1;
        $return['data'] = $renturnModel;
        $return['msj'] = "No hay registros aún";    
        return response()->json($return);   
    }


    public function insertarEvaluacion($objArr)
    {
        DB::beginTransaction();
        try
        {
          foreach ($objArr->gestor as $k=>$value)
          {
              $curso = Curso::where('curso', '=', trim($value->curso))
                                    ->where('curso_externo_id','=', trim($value->curso_externo_id))
                                    ->first();
              if (count($curso) == 0)
              {
                $curso = Curso::where('curso_externo_id', '=', trim($value->curso_externo_id))
                                        ->first();
                if(count($curso) == 0) //Insert
                {
                  $curso = new Curso();
                  $curso->curso_externo_id = trim($value->curso_externo_id);
                  $curso->persona_id_created_at=1;
                }
                else //Update
                  $curso->persona_id_updated_at=1;

                $curso->curso = trim($value->curso);
                $curso->save();
              }

              // Proceso Persona Docente
              $docente = Persona::where('dni', '=', trim($value->docente_dni))
                                  ->first();
              if (count($docente) == 0)
              {
                  $docente = new Persona();
                  $docente->dni = trim($value->docente_dni);
                  $docente->persona_id_created_at=1;
              }
              else
                  $docente->persona_id_updated_at=1;

              $docente->paterno = trim($value->docente_paterno);
              $docente->materno = trim($value->docente_materno);
              $docente->nombre = trim($value->docente_nombre);
              $docente->save();
              // --

              // Proceso Programación Unica
              $programacion_unica = ProgramacionUnica::where('programacion_unica_externo_id', '=', trim($value->programacion_unica_externo_id))
                                                      ->first();
              if (count($programacion_unica) == 0)
              {
                  $programacion_unica = new ProgramacionUnica();
                  $programacion_unica->programacion_unica_externo_id = trim($value->programacion_unica_externo_id);
                  $programacion_unica->persona_id_created_at=1;
              }
              else{
                  $programacion_unica->estado=$value->programacion_unica_estado;
                  $programacion_unica->persona_id_updated_at=1;
              }

              $programacion_unica->curso_id = $curso->id;
              $programacion_unica->persona_id = $docente->id;
              $programacion_unica->fecha_inicio = $value->fecha_inicio;
              $programacion_unica->fecha_final = $value->fecha_final;
              $programacion_unica->save();
              // --

          }

          DB::commit();
          $return = true;
        }
        catch (\Exception $e)
        {
            DB::rollback();
            //dd($e);
            $return = false;
        }
        return $return;
    }



    public function curl($url, $data=array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }

    private function getIPCliente()
    {
        if (isset($_SERVER["HTTP_CLIENT_IP"]))
            return $_SERVER["HTTP_CLIENT_IP"];
        elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
            return $_SERVER["HTTP_X_FORWARDED"];
        elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
            return $_SERVER["HTTP_FORWARDED_FOR"];
        elseif (isset($_SERVER["HTTP_FORWARDED"]))
            return $_SERVER["HTTP_FORWARDED"];
        else
            return $_SERVER["REMOTE_ADDR"];
    }

}

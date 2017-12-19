<?php
namespace App\Http\Controllers\Mantenimiento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\Api;
use App\Models\Mantenimiento\Curso;
use DB;

class CursoEM extends Controller{
    private $api;
    public function __construct(){
         $this->api = new Api();
    }

    public function Load(Request $r ){
        if ( $r->ajax() ) {
            $renturnModel = Curso::runLoad($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);
        }
    }

    public function validarCursoMaster(Request $r){

        $cli_links = DB::table('clientes_accesos_links')->where('cliente_acceso_id','=', 1)
                                                        ->where('tipo','=', 8)
                                                        ->first();
        $objArr = $this->api->curl($cli_links->url);
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
                $val = $this->insertarCurso($objArr);
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
        $renturnModel = Curso::runLoad($r);
        $return['rst'] = 1;
        $return['data'] = $renturnModel;
        $return['msj'] = "No hay registros aún";
        return response()->json($return);
    }

    public function insertarCurso($objArr){
        DB::beginTransaction();
        $array_curso='0';
        $array_programacion_unica='0';
        $array_programacion='0';

        try{

          foreach ($objArr->curso as $k=>$value)
          {
            $curso = Curso::where('curso', '=', trim($value->curso))
                                  ->where('carrera','=', trim($value->carrera))
                                  ->where('ciclo','=', trim($value->ciclo))
                                  ->where('curso_externo_id','=', trim($value->curso_externo_id))
                                  ->first();
              if (count($curso) == 0)
              {
                $curso = Curso::where('curso_externo_id', '=', trim($value->curso_externo_id))
                                        ->first();
                if(count($curso) == 0) //Insert
                {
                  $curso = new Curso();
                  $curso->carrera = trim($value->carrera);
                  $curso->ciclo = trim($value->ciclo);
                  $curso->curso_externo_id = trim($value->curso_externo_id);
                  $curso->persona_id_created_at=1;
                }
                else //Update
                  $curso->persona_id_updated_at=1;

                $curso->curso = trim($value->curso);
                $curso->carrera = trim($value->carrera);
                $curso->ciclo = trim($value->ciclo);
                $curso->save();
                $array_curso.=','.$curso->curso_externo_id;
              }
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

    public function Edit(Request $r )
    {
        if ( $r->ajax() ) {
            $mensaje= array(
                'required'    => ':attribute es requerido',
                'unique'        => ':attribute solo debe ser único',
            );

            $rules = array(
                'imagen_nombre' =>
                       ['required',
                        ],
            );

            $validator=Validator::make($r->all(), $rules,$mensaje);

            if ( !$validator->fails() ) {
                Curso::runEdit($r);
                $return['rst'] = 1;
                $return['msj'] = 'Registro actualizado';
            }
            else{
                $return['rst'] = 2;
                $return['msj'] = $validator->errors()->all()[0];
            }
            return response()->json($return);
        }
    }
}

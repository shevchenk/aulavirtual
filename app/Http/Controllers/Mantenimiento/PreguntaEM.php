<?php
namespace App\Http\Controllers\Mantenimiento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mantenimiento\Pregunta;
use App\Models\Mantenimiento\TipoEvaluacion;
use App\Models\Mantenimiento\Curso;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Api\Api;
use DB;

class PreguntaEM extends Controller
{
    private $api;
    public function __construct()
    {
        $this->api = new Api();
        $this->middleware('auth');  //Esto debe activarse cuando estemos con sessión
    }

    public function EditStatus(Request $r )
    {
        if ( $r->ajax() ) {
            Pregunta::runEditStatus($r);
            $return['rst'] = 1;
            $return['msj'] = 'Registro actualizado';
            return response()->json($return);
        }
    }

   public function New(Request $r )
    {
        if ( $r->ajax() ) {

            $mensaje= array(
                'required'    => ':attribute es requerido',
                'unique'      => ':attribute solo debe ser único',
            );

            $rules = array(
                'pregunta' =>
                       ['required',
                        Rule::unique('v_preguntas','pregunta')->where(function ($query) use($r) {
                                $query->where('curso_id',$r->curso_id );
                        }),
                        ],
            );

            $validator=Validator::make($r->all(), $rules,$mensaje);

            if ( !$validator->fails() ) {
                Pregunta::runNew($r);
                $return['rst'] = 1;
                $return['msj'] = 'Registro creado';
            }
            else{
                $return['rst'] = 2;
                $return['msj'] = $validator->errors()->all()[0];
            }
            return response()->json($return);
        }
    }

    public function Edit(Request $r )
    {
        if ( $r->ajax() ) {
            $mensaje= array(
                'required'    => ':attribute es requerido',
                'unique'        => ':attribute solo debe ser único',
            );

            $rules = array(
                'pregunta' =>
                       ['required',
                        Rule::unique('v_preguntas','pregunta')->ignore($r->id)->where(function ($query) use($r) {
                                $query->where('curso_id',$r->curso_id );
                        }),
                        ],
            );

            $validator=Validator::make($r->all(), $rules,$mensaje);

            if ( !$validator->fails() ) {
                Pregunta::runEdit($r);
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

    public function Load(Request $r )
    {
        if ( $r->ajax() ) {
            $renturnModel = Pregunta::runLoad($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);
        }
    }

    public function ListCursos (Request $r )
    {
        if ( $r->ajax() ) {
            $renturnModel = Curso::ListCursos($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);
        }
    }

    public function ListTipoEvaluacion (Request $r )
    {
        if ( $r->ajax() ) {
            $cli_links = DB::table('clientes_accesos_links')->where('cliente_acceso_id','=', 1)
                                                        ->where('tipo','=',9)
                                                        ->first();
            $objArr = $this->api->curl($cli_links->url);
            // --
            $return_response = '';

            if (empty($objArr)){
                $return_response = $this->api->response(422,"error","Ingrese sus datos de envio");
            }
            else if(isset($objArr->key[0]->id) && isset($objArr->key[0]->token)){
                $tab_cli = DB::table('clientes_accesos')->select('id', 'nombre', 'key', 'url', 'ip')
                                                        ->where('id','=', $objArr->key[0]->id)
                                                        ->where('key','=', $objArr->key[0]->token)
                                                        ->where('estado','=', 1)
                                                        ->first();

                if($objArr->key[0]->id == @$tab_cli->id && $objArr->key[0]->token == @$tab_cli->key){
                    $val = $this->insertarTipoEvaluacion($objArr);
                    if($val['return'] == true){
                        $this->api->curl('localhost/Cliente/Retorno.php',$val['externo_id']);
                        $return_response = $this->api->response(200,"success","Proceso ejecutado satisfactoriamente");
                    }else
                        $return_response = $this->api->response(422,"error","Retorno de Keys dio error");
                }
                else{
                    $return_response = $this->api->response(422 ,"error","Su Parametro de seguridad son incorrectos");
                }
            }
            else{
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
            
            $renturnModel = TipoEvaluacion::ListTipoEvaluacion($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);
        }
    }
    public function insertarTipoEvaluacion($objArr){
        DB::beginTransaction();
        $array_curso='0';
        $array_programacion_unica='0';
        $array_programacion='0';
        $array_tipo_evaluacion='0';
        
        try{

          foreach ($objArr->tipo as $k=>$value){
              $tipo_evaluacion = TipoEvaluacion::where('tipo_evaluacion', '=', trim($value->tipo_evaluacion))
                                    ->where('tipo_evaluacion_externo_id','=', trim($value->tipo_evaluacion_externo_id))
                                    ->first();
              if (count($tipo_evaluacion) == 0){
                  
                $tipo_evaluacion = TipoEvaluacion::where('tipo_evaluacion_externo_id', '=', trim($value->tipo_evaluacion_externo_id))
                                        ->first();
                if(count($tipo_evaluacion) == 0) //Insert
                {
                  $tipo_evaluacion = new TipoEvaluacion();
                  $tipo_evaluacion->tipo_evaluacion_externo_id = trim($value->tipo_evaluacion_externo_id);
                  $tipo_evaluacion->persona_id_created_at=1;
                }
                else //Update
                  $tipo_evaluacion->persona_id_updated_at=1;

                $tipo_evaluacion->tipo_evaluacion = trim($value->tipo_evaluacion);
                $tipo_evaluacion->save();
                $array_tipo_evaluacion.=','.$tipo_evaluacion->tipo_evaluacion_externo_id;
              }
          }

          DB::commit();
          $data['return']= true;
          $data['externo_id']=array('tipo_evaluacion'=>$array_tipo_evaluacion,'curso'=>$array_curso,'programacion_unica'=>$array_programacion_unica,'programacion'=>$array_programacion);
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

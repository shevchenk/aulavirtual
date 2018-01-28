<?php
namespace App\Http\Controllers\Mantenimiento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mantenimiento\Balotario;
use App\Models\Proceso\ProgramacionUnica;
use App\Models\Proceso\TipoEvaluacion;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Controllers\Api\Api;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PDF;
use App\Models\Mantenimiento\BalotarioPregunta;

class BalotarioEM extends Controller
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
            Balotario::runEditStatus($r);
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
                'programacion_unica_id' => 
                       ['required',
                        Rule::unique('v_balotarios','programacion_unica_id')->where(function ($query) use($r) {
                                $query->where('tipo_evaluacion_id',$r->tipo_evaluacion_id );
                        }),
                        ],
            );

            
            $validator=Validator::make($r->all(), $rules,$mensaje);

            if ( !$validator->fails() ) {
                Balotario::runNew($r);
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
                'programacion_unica_id' => 
                       ['required',
                        Rule::unique('v_balotarios','programacion_unica_id')->ignore($r->id)->where(function ($query) use($r) {
                                $query->where('tipo_evaluacion_id',$r->tipo_evaluacion_id );
                        }),
                        ],
            );

            $validator=Validator::make($r->all(), $rules,$mensaje);

            if ( !$validator->fails() ) {
                Balotario::runEdit($r);
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
    
    public function Load(Request $r ){
        if ( $r->ajax() ) {
            $renturnModel = Balotario::runLoad($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";    
            return response()->json($return);   
        }
    }

    public function ValidarTipoEvaluacionBalotario(Request $r ){
        if ( $r->ajax() ) {
            //$idcliente = session('idcliente');
            $programacionUnica = ProgramacionUnica::find($r->programacion_unica_id);

            $param_data = array('dni' => Auth::user()->dni,
                                  'programacion_unica_externo_id' => $programacionUnica->programacion_unica_externo_id);
            // URL (CURL)
            $cli_links = DB::table('clientes_accesos_links')->where('cliente_acceso_id','=',1)
                                                            ->where('tipo','=', 12)
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
                    $val = $this->insertarTipoEvaluacionBalotario($objArr, $r);
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
            $renturnModel = Balotario::runLoad($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";    
            return response()->json($return);   
        }
    }
    
     public function insertarTipoEvaluacionBalotario($objArr, $r){
         
        DB::beginTransaction();
        try{ 
            
          foreach ($objArr->tipo as $k=>$value){

                $te= TipoEvaluacion::where('tipo_evaluacion_externo_id','=',$value->tipo_evaluacion_externo_id)
                                    ->where('tipo_evaluacion', '=', trim($value->tipo_evaluacion))->first();
                $pu= ProgramacionUnica::where('programacion_unica_externo_id','=',$value->programacion_unica_externo_id)->first();

                $tipoeval=Balotario::where('v_balotarios.tipo_evaluacion_id','=', trim($te->id))
                                        ->where('v_balotarios.programacion_unica_id','=', trim($pu->id))
                                        ->first();

                if(count($tipoeval) == 0){ //Insert
                  $tipoeval = new Balotario();
                  $tipoeval->programacion_unica_id = trim($r->programacion_unica_id);
                  $tipoeval->tipo_evaluacion_id = trim($te->id);
                  $tipoeval->persona_id_created_at=1;
                  $tipoeval->cantidad_maxima =0;
                  $tipoeval->cantidad_pregunta =0;
                }else{
                  $tipoeval->estado=trim($value->tipo_evaluacion_estado);
                  $tipoeval->persona_id_updated_at=2;
                }

                $tipoeval->save();

          }
          DB::commit();
          $data['return']= true;
          
        }catch (\Exception $e){
            //var_dump($e);exit();
            DB::rollback();
            $data['return']= false;
        }
        return $data;
    }
    
    public function GenerateBallot(Request $r ){
        if ( $r->ajax() ) {
            
            $rst=Balotario::runGenerateBallot($r);
            
            if($rst['rst']==1){
                $return['msj'] = 'Balotario Generado';
            }else{
                $return['msj'] = 'Balotario no Generado por que falta '.$rst['falta'].' pregunta(s) en: '.$rst['unidad_contenido'];
            }
            
            $return['rst'] = $rst['rst'];
            return response()->json($return);
        }
    }
    
    public function GenerarPDF(Request $r) {

        $renturnModel = BalotarioPregunta::runLoad($r);
        $HeadBallotPdf=Balotario::runHeadBallotPdf($r);

        $preguntas = array();
        foreach ($renturnModel as $data) {
        $pregunta = $data->pregunta.'|'.$data->imagen;
            if (isset($preguntas[$pregunta])) {
                $preguntas[$pregunta][] = $data;
            } else {
                $preguntas[$pregunta] = array($data);
            }
        }
        
        $data = ['preguntas' => $preguntas,'head'=>$HeadBallotPdf];

	$pdf = PDF::Make();
        $pdf->SetHeader('TELESUP|Balotario de Preguntas|{PAGENO}');
        $pdf->SetFooter('TELESUP');

	$pdf->loadView('mantenimiento.plantilla.plantillapdf', $data);
	return $pdf->Stream('document.pdf');

        
        
//        $pdf = PDF::make();
//        $content = "<ul><li>Hello this is first pdf file.</li></ul>";
//	$pdf->WriteHTML($content);
//	return $pdf->Stream('document.pdf');

    }
    
}

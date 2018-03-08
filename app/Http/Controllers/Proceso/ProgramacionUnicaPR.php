<?php
namespace App\Http\Controllers\Proceso;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Excel;
use App\Http\Controllers\Api\Api;
use App\Models\Proceso\ProgramacionUnica;
use App\Models\Proceso\Curso;
use App\Models\Proceso\Persona;

class ProgramacionUnicaPR extends Controller{

    private $api;

    public function __construct()
    {
        $this->api = new Api();
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

    public function validarProgramacionMaster(Request $r){

        $cli_links = DB::table('clientes_accesos_links')->where('cliente_acceso_id','=', 1)
                                                        ->where('tipo','=', 6)
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
                $val = $this->insertarProgramacionMaster($objArr);
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
        $renturnModel = ProgramacionUnica::runLoad($r);
        $return['rst'] = 1;
        $return['data'] = $renturnModel;
        $return['msj'] = "No hay registros aún";
        return response()->json($return);
    }

    public function validarProgramacion(Request $r)
    {
        $idcliente = session('idcliente');
        $param_data = array('dni' => Auth::user()->dni);

        // URL (CURL)
        $cli_links = DB::table('clientes_accesos_links')->where('cliente_acceso_id','=', $idcliente)
                                                        ->where('tipo','=', 4)
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
                $val = $this->insertarProgramacion($objArr);
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
        $r['dni'] = Auth::user()->dni;
        $renturnModel = ProgramacionUnica::runLoad($r);
        $return['rst'] = 1;
        $return['data'] = $renturnModel;
        $return['msj'] = "No hay registros aún";
        return response()->json($return);
    }


    public function insertarProgramacion($objArr){
        DB::beginTransaction();
        $array_curso='0';
        $array_programacion_unica='0';
        $array_programacion='0';

        try{

          foreach ($objArr->docente as $k=>$value){

              // Proceso Persona Docente
              $docente = Persona::where('dni', '=', trim($value->docente_dni))
                                  ->first();

              if (count($docente) == 0){
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
          }

          DB::commit();
          $data['return']= true;
          $data['externo_id']=array('curso'=>$array_curso,'programacion_unica'=>$array_programacion_unica,'programacion'=>$array_programacion);

        }catch (\Exception $e){
            DB::rollback();
            //dd($e);
           $data['return']= false;
        }
        return $data;
    }

    public function insertarProgramacionMaster($objArr){
        DB::beginTransaction();
        $array_curso='0';
        $array_programacion_unica='0';
        $array_programacion='0';

        try{

          foreach ($objArr->gestor as $k=>$value){

              $curso = Curso::where('curso', '=', trim($value->curso))
                                    ->where('curso_externo_id','=', trim($value->curso_externo_id))
                                    ->first();

              if (count($curso) == 0){

                $curso = Curso::where('curso_externo_id', '=', trim($value->curso_externo_id))
                                        ->first();
                if(count($curso) == 0){ //Insert
                  $curso = new Curso();
                  $curso->curso_externo_id = trim($value->curso_externo_id);
                  $curso->persona_id_created_at=1;
                }
                else //Update
                  $curso->persona_id_updated_at=1;

                $curso->curso = trim($value->curso);
                $curso->save();
                $array_curso.=','.$curso->curso_externo_id;
                //dd($value->carrera);
              }

              // Proceso Persona Docente
              $docente = Persona::where('dni', '=', trim($value->docente_dni))
                                  ->first();

              if (count($docente) == 0){

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
              if (count($programacion_unica) == 0){
                  $programacion_unica = new ProgramacionUnica();
                  $programacion_unica->programacion_unica_externo_id = trim($value->programacion_unica_externo_id);
                  $programacion_unica->persona_id_created_at=1;
              }
              else{
                  $programacion_unica->estado=$value->programacion_unica_estado;
                  $programacion_unica->persona_id_updated_at=1;
              }
              $programacion_unica->carrera = trim($value->carrera);
              $programacion_unica->ciclo = trim($value->ciclo);
              $programacion_unica->semestre = trim($value->semestre);
              $programacion_unica->curso_id = $curso->id;
              $programacion_unica->persona_id = $docente->id;
              $programacion_unica->fecha_inicio = $value->fecha_inicio;
              $programacion_unica->fecha_final = $value->fecha_final;
              $programacion_unica->save();
              $array_programacion_unica.=','.$programacion_unica->programacion_unica_externo_id;
              // --

          }

          DB::commit();
          $data['return']= true;
          $data['externo_id']=array('curso'=>$array_curso,'programacion_unica'=>$array_programacion_unica,'programacion'=>$array_programacion);

        }catch (\Exception $e){
            DB::rollback();
            //dd($e);
           $data['return']= false;
        }
        return $data;
    }

    public function ExportNota(Request $r ){
        
        ini_set('memory_limit', '1024M');
        set_time_limit(300);
        $renturnModel = ProgramacionUnica::runExportNota($r);

        Excel::create('Notas', function($excel) use($renturnModel) {

        $excel->setTitle('Reporte de Notas')
              ->setCreator('Jorge Salcedo')
              ->setCompany('JS Soluciones')
              ->setDescription('Reporte de Notas');

        $excel->sheet('Nota', function($sheet) use($renturnModel) {
            $sheet->setOrientation('landscape');
            $sheet->setPageMargin(array(
                0.25, 0.30, 0.25, 0.30
            ));

            $sheet->setStyle(array(
                'font' => array(
                    'name'      =>  'Bookman Old Style',
                    'size'      =>  8,
                    'bold'      =>  false
                )
            ));

            $valores=array(
                        'data' => json_decode(json_encode($renturnModel['data']), true),
                        'campos'=>$renturnModel['campos'],
                        'cabecera1'=>$renturnModel['cabecera1'],
                        'cabecant'=>$renturnModel['cabecantNro'],
                        'cabecera2'=>$renturnModel['cabecera2']
                    );

            $sheet->loadView('reporte.exportar.nota', $valores);
            $sheet->setAutoSize(array(
                'R','S','T','U'
            ));

            $count = $sheet->getHighestRow();

            $sheet->getStyle('R5:U'.$count)->getAlignment()->setWrapText(true);
            
            $sheet->setBorder('A3:'.$renturnModel['max'].$count, 'thin');

        });
        
        })->export('xlsx');
        
    }
    
    public function ExportAuditoriaE(Request $r ){
        
        ini_set('memory_limit', '1024M');
        set_time_limit(300);
        $renturnModel = ProgramacionUnica::runExportAuditoriaE($r);

        Excel::create('Auditoria Evaluación', function($excel) use($renturnModel) {

        $excel->setTitle('Reporte de Auditoria de Evaluaciones')
              ->setCreator('Jorge Salcedo')
              ->setCompany('JS Soluciones')
              ->setDescription('Reporte de Auditoria de Evaluaciones');

        $excel->sheet('Auditoria', function($sheet) use($renturnModel) {
            $sheet->setOrientation('landscape');
            $sheet->setPageMargin(array(
                0.25, 0.30, 0.25, 0.30
            ));

            $sheet->setStyle(array(
                'font' => array(
                    'name'      =>  'Bookman Old Style',
                    'size'      =>  8,
                    'bold'      =>  false
                )
            ));

            $valores=array(
                        'data' => json_decode(json_encode($renturnModel['data']), true),
                        'campos'=>$renturnModel['campos'],
                        'cabecera1'=>$renturnModel['cabecera1'],
                        'cabecant'=>$renturnModel['cabecantNro'],
                        'cabecera2'=>$renturnModel['cabecera2']
                    );
            
            $sheet->loadView('reporte.exportar.auditoriae', $valores);
            $sheet->setAutoSize(array(
                'R','S','T','U'
            ));

            $count = $sheet->getHighestRow();

            $sheet->getStyle('R5:U'.$count)->getAlignment()->setWrapText(true);
            
            $sheet->setBorder('A3:'.$renturnModel['max'].$count, 'thin');

        });
        
        })->export('xlsx');
        
    }
    
    public function ExportAuditoriaC(Request $r ){
        
        ini_set('memory_limit', '1024M');
        set_time_limit(300);
        $renturnModel = ProgramacionUnica::runExportAuditoriaC($r);

        Excel::create('Auditoria Contenido', function($excel) use($renturnModel) {

        $excel->setTitle('Reporte de Auditoria de Contenido')
              ->setCreator('Jorge Salcedo')
              ->setCompany('JS Soluciones')
              ->setDescription('Reporte de Auditoria de Contenido');

        $excel->sheet('Auditoria', function($sheet) use($renturnModel) {
            $sheet->setOrientation('landscape');
            $sheet->setPageMargin(array(
                0.25, 0.30, 0.25, 0.30
            ));

            $sheet->setStyle(array(
                'font' => array(
                    'name'      =>  'Bookman Old Style',
                    'size'      =>  8,
                    'bold'      =>  false
                )
            ));

            $valores=array(
                        'dataI' => json_decode(json_encode($renturnModel['dataI']), true),
                        'dataM' => json_decode(json_encode($renturnModel['dataM']), true),
                        'campos'=>$renturnModel['campos'],
                        'cabecera1'=>$renturnModel['cabecera1'],
                        'cabecant'=>$renturnModel['cabecantNro'],
                        'cabecera2'=>$renturnModel['cabecera2']
                    );
            
            $sheet->loadView('reporte.exportar.auditoriac', $valores);
            $sheet->setAutoSize(array(
                'R','S','T','U'
            ));

            $count = $sheet->getHighestRow();

            $sheet->getStyle('R5:U'.$count)->getAlignment()->setWrapText(true);
            
            $sheet->setBorder('A3:'.$renturnModel['max'].$count, 'thin');

        });
        
        })->export('xlsx');
        
    }
    
    public function EditTemplate(Request $r ){
        if ( $r->ajax() ) {
            ProgramacionUnica::runEditTemplate($r);
            $return['rst'] = 1;
            $return['msj'] = 'Registro actualizado';
            return response()->json($return);
        }
    }
    
    public function ReplicarTemplate(Request $r ){
        if ( $r->ajax() ) {
            $result=ProgramacionUnica::runReplicarTemplate($r);
            $return['rst'] = $result["rst"];
            $return['msj'] = $result["msj"];
            return response()->json($return);
        }
    }
}

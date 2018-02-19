<?php

namespace App\Http\Controllers\Proceso;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Mantenimiento\Curso;
use App\Models\Mantenimiento\UnidadContenido;
use App\Models\Mantenimiento\Pregunta;
use App\Models\Mantenimiento\Respuesta;
use Excel;

class CargaPR extends Controller {

    public function __construct() {
        $this->middleware('auth');  //Esto debe activarse cuando estemos con sessión
    }

    public function CargaPreguntaRespuesta() {

        ini_set('memory_limit', '512M');
        if (isset($_FILES['carga']) and $_FILES['carga']['size'] > 0) {

            $uploadFolder = 'txt/preguntarespuesta';

            if (!is_dir($uploadFolder)) {
                mkdir($uploadFolder);
            }

            $nombreArchivo = explode(".", $_FILES['carga']['name']);
            $tmpArchivo = $_FILES['carga']['tmp_name'];
            $archivoNuevo = $nombreArchivo[0] . "_u" . Auth::user()->id . "_" . date("Ymd_his") . "." . $nombreArchivo[1];
            $file = $uploadFolder . '/' . $archivoNuevo;

            $m = "Ocurrio un error al subir el archivo. No pudo guardarse.";
            if (!move_uploaded_file($tmpArchivo, $file)) {
                $return['rst'] = 2;
                $return['msj'] = $m;
                return response()->json($return);
            }
            
            $array_error = array();
            $no_pasa = 0;
            $array = array();

            $file = file('txt/preguntarespuesta/' . $archivoNuevo);

            for ($i = 0; $i < count($file); $i++) {

                DB::beginTransaction();
                if (trim($file[$i]) != '') {
                    $detfile = explode("\t", $file[$i]);

                    $con = 0;
                    for ($j = 0; $j < count($detfile); $j++) {
                        $buscar = array(chr(13) . chr(10), "\r\n", "\n", "�", "\r", "\n\n", "\xEF", "\xBB", "\xBF");
                        $reemplazar = "";
                        $detfile[$j] = trim(str_replace($buscar, $reemplazar, $detfile[$j]));
                        $array[$i][$j] = $detfile[$j];
                        $con++;
                    }
                    $curso = Curso::where('curso', '=', trim(utf8_encode($detfile[0])))
                                    ->where('estado','=',1)->first();
                    $unidadcontenido =UnidadContenido::where('unidad_contenido', '=', trim(utf8_encode($detfile[1])))
                                                    ->where('estado','=',1)->first();

                    if (count($unidadcontenido) == 0 or count($curso) == 0) {
                        
                        if(count($curso) == 0){
                              $msg_error = ($i+1).'- Motivo: No se encontro Curso: '.trim(utf8_encode($detfile[0])).'<br>'; 
                              array_push($array_error, $msg_error);
                        }
                        if(count($unidadcontenido) == 0){
                              $msg_error = ($i+1).'- Motivo: No se encontro Unidad de Contenido: '.trim(utf8_encode($detfile[1])).'<br>'; 
                              array_push($array_error, $msg_error);  
                        }
                        $no_pasa=$no_pasa+1;
                        DB::rollBack();
                        continue;
                        
                    } else {
                        $vpregunta =Pregunta::where('pregunta', '=', trim(utf8_encode($detfile[2])))->first();
                        if( count($vpregunta)>0 ){
                            $pregunta= Pregunta::find($vpregunta->id);
                            $pregunta->estado=1;
                            $pregunta->persona_id_updated_at = Auth::user()->id;
                        }
                        else{
                            $pregunta = new Pregunta;
                            $pregunta->pregunta = trim(utf8_encode($detfile[2]));
                            $pregunta->puntaje = 1;
                            $pregunta->persona_id_created_at = Auth::user()->id;
                        }
                        $pregunta->curso_id = $curso->id;
                        $pregunta->unidad_contenido_id = $unidadcontenido->id;
                        $pregunta->save();

                        for ($h = 3; $h < count($detfile); $h += 2) {
                            if (trim($detfile[$h]) != '') {
                                $vrespuesta =Respuesta::where('respuesta', '=', trim(utf8_encode($detfile[$h])))
                                             ->where('pregunta_id','=',$pregunta->id)->first();
                                if( count($vrespuesta)>0 ){
                                    $respuesta= Respuesta::find($vrespuesta->id);
                                    $respuesta->persona_id_created_at = Auth::user()->id;
                                }
                                else{
                                    $respuesta = new Respuesta;
                                    $respuesta->pregunta_id = $pregunta->id;
                                    $respuesta->tipo_respuesta_id = 1;
                                    $respuesta->respuesta = trim(utf8_encode($detfile[$h]));
                                    $respuesta->persona_id_created_at = Auth::user()->id;
                                    
                                }
                                    $respuesta->correcto = $detfile[$h + 1];
                                    $respuesta->puntaje = $detfile[$h + 1];
                                    $respuesta->save();
                            }
                        }
                    }
                }
                DB::commit();
            }

            if (count($array_error) > 0 or count($no_pasa) > 1) {
                    $return['error_carga'] = $array_error;
                    $return['no_pasa'] = $no_pasa;
                    $return['rst'] = 2;
                    $return['msj'] = 'Existieron algunos errores';
            } else {
                    $return['rst'] = 1;
                    $return['msj'] = 'Archivo procesado correctamente';
            }

            return response()->json($return);
        }
    }
    
    public function ExportPlantilla(Request $r ){
        $renturnModel = $this->runExportPlantilla($r);
        
        Excel::create('Plantilla', function($excel) use($renturnModel) {

        $excel->setTitle('Plantilla de carga')
              ->setCreator('Jorge Salcedo')
              ->setCompany('JS Soluciones')
              ->setDescription('Plantilla de carga de preguntas y respuestas');

        $excel->sheet('Plantillas', function($sheet) use($renturnModel) {
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

            $sheet->cell('A1', function($cell) {
                $cell->setValue('CARGA DE PREGUNTAS Y RESPUESTAS');
                $cell->setFont(array(
                    'family'     => 'Bookman Old Style',
                    'size'       => '20',
                    'bold'       =>  true
                ));
            });
            $sheet->mergeCells('A1:'.$renturnModel['max'].'1');
            $sheet->cells('A1:'.$renturnModel['max'].'1', function($cells) {
                $cells->setBorder('solid', 'none', 'none', 'solid');
                $cells->setAlignment('center');
                $cells->setValignment('center');
            });

            $sheet->setWidth($renturnModel['length']);
            $sheet->fromArray(array(
                array(''),
                $renturnModel['cabecera']
            ));

            $data=json_decode(json_encode($renturnModel['data']), true);
            $sheet->rows($data);

            $sheet->cells('A3:'.$renturnModel['max'].'3', function($cells) {
                $cells->setBorder('solid', 'none', 'none', 'solid');
                $cells->setAlignment('center');
                $cells->setValignment('center');
                $cells->setFont(array(
                    'family'     => 'Bookman Old Style',
                    'size'       => '10',
                    'bold'       =>  true
                ));
            });
            
            $sheet->setAutoSize(array(
                'M', 'N','O'
            ));

            $count = $sheet->getHighestRow();

            $sheet->getStyle('M4:O'.$count)->getAlignment()->setWrapText(true);
            
            $sheet->setBorder('A3:'.$renturnModel['max'].$count, 'thin');

        });
        
        })->export('xlsx');
    }
    
    public static function runExportPlantilla($r){
        
        $rsql= array();

        $length=array(
            'A'=>5,'B'=>15,'C'=>20,'D'=>20,'E'=>20,'F'=>15,'G'=>15,'H'=>25,'I'=>30,
            'J'=>15,'K'=>15,
        );
        $cabecera=array(
            'Curso','Unidad de Contenido','Pregunta','Respuesta 1','Alternativa Correcta 1','Respuesta 2','Alternativa Correcta 2',
            'Respuesta 3','Alternativa Correcta 3','Respuesta n','Alternativa Correcta n'
        );
        $campos=array();

        $r['data']=$rsql;
        $r['cabecera']=$cabecera;
        $r['campos']=$campos;
        $r['length']=$length;
        $r['max']='K'; // Max. Celda en LETRA
        return $r;
    }

    public function ExportGestorContenido(Request $r ){
        $renturnModel = $this->runExportGestorContenido($r);
        
        Excel::create('Plantilla', function($excel) use($renturnModel) {

        $excel->setTitle('Gestor Contenido')
              ->setCreator('Jorge Salcedo')
              ->setCompany('JS Soluciones')
              ->setDescription('Situación del gestor de contenido');

        $excel->sheet('GC', function($sheet) use($renturnModel) {
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

            $sheet->cell('A1', function($cell) {
                $cell->setValue('Resumen Gestor de Contenido');
                $cell->setFont(array(
                    'family'     => 'Bookman Old Style',
                    'size'       => '20',
                    'bold'       =>  true
                ));
            });
            $sheet->mergeCells('A1:'.$renturnModel['max'].'1');
            $sheet->cells('A1:'.$renturnModel['max'].'1', function($cells) {
                $cells->setBorder('solid', 'none', 'none', 'solid');
                $cells->setAlignment('center');
                $cells->setValignment('center');
            });

            $sheet->setWidth($renturnModel['length']);
            $sheet->fromArray(array(
                array(''),
                $renturnModel['cabecera']
            ));

            $data=json_decode(json_encode($renturnModel['data']), true);
            $sheet->rows($data);

            $sheet->cells('A3:'.$renturnModel['max'].'3', function($cells) {
                $cells->setBorder('solid', 'none', 'none', 'solid');
                $cells->setAlignment('center');
                $cells->setValignment('center');
                $cells->setFont(array(
                    'family'     => 'Bookman Old Style',
                    'size'       => '10',
                    'bold'       =>  true
                ));
            });
            
            /*$sheet->setAutoSize(array(
                'M', 'N','O'
            ));*/

            $count = $sheet->getHighestRow();

            $sheet->getStyle('M4:O'.$count)->getAlignment()->setWrapText(true);
            
            $sheet->setBorder('A3:'.$renturnModel['max'].$count, 'thin');

        });
        
        })->export('xlsx');
    }

    public static function runExportGestorContenido($r){
        
        $rsql= array();

        $length=array(
            'A'=>5,'B'=>15,'C'=>20,'D'=>20,'E'=>20,'F'=>15,'G'=>15,'H'=>25,'I'=>30,
            'J'=>15,'K'=>15,
        );
        $cabecera=array(
            'Curso','Unidad de Contenido','Pregunta','Respuesta 1','Alternativa Correcta 1','Respuesta 2','Alternativa Correcta 2',
            'Respuesta 3','Alternativa Correcta 3','Respuesta n','Alternativa Correcta n'
        );
        $campos=array();

        $r['data']=$rsql;
        $r['cabecera']=$cabecera;
        $r['campos']=$campos;
        $r['length']=$length;
        $r['max']='K'; // Max. Celda en LETRA
        return $r;
    }

}

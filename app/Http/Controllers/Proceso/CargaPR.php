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

                        $pregunta = new Pregunta;
                        $pregunta->curso_id = $curso->id;
                        $pregunta->unidad_contenido_id = $unidadcontenido->id;
                        $pregunta->pregunta = trim(utf8_encode($detfile[2]));
                        $pregunta->puntaje = 1;
                        $pregunta->persona_id_created_at = Auth::user()->id;
                        $pregunta->save();

                        for ($h = 3; $h < count($detfile); $h += 2) {
                            if (trim($detfile[$h]) != '') {
                                $respuesta = new Respuesta;
                                $respuesta->pregunta_id = $pregunta->id;
                                $respuesta->tipo_respuesta_id = 1;
                                $respuesta->respuesta = trim(utf8_encode($detfile[$h]));
                                $respuesta->puntaje = 1;
                                $respuesta->correcto = $detfile[$h + 1];
                                $respuesta->persona_id_created_at = Auth::user()->id;
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

}

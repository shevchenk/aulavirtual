<?php
namespace App\Http\Controllers\Proceso;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

use App\Models\Proceso\Contenido;
use App\Models\Proceso\ContenidoRespuesta;
use App\Models\Proceso\ContenidoProgramacion;
use App\Models\Proceso\Programacion;

class ContenidoRespuestaPR extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  //Esto debe activarse cuando estemos con sessión
    }

    public function Load(Request $r )
    {
        if ( $r->ajax() ) {
            $renturnModel = ContenidoRespuesta::runLoad($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);
        }
    }

    public function New(Request $r )
    {
         if($r->ajax())
         {
             $mensaje= array(
                 'required'    => ':attribute es requerido',
                 'unique'      => ':attribute solo debe ser único',
             );

             $rules = array(
                 'contenido_id' =>
                        ['required'],
             );

             $validator=Validator::make($r->all(), $rules,$mensaje);
             $msj = false;
             $fecha_actual = date('Y-m-d');

             if(!$validator->fails())
             {
               $programacion = Programacion::where('programacion_unica_id', '=', $r->programacion_unica_id)
                                             ->where('persona_id','=', Auth::user()->id)
                                             ->where('estado','=', 1)
                                             ->first();
              if (count($programacion) == 0)
              {
                  $return['rst'] = 4;
                  $return['msj'] = 'La programación esta inactivo!';
              }
              else
              {
                  $r['programacion_id'] = $programacion->id;

                  //Proceso de validación
                  $contenido = Contenido::find($r->contenido_id);
                  if($contenido->fecha_final >= $fecha_actual) {
                     ContenidoRespuesta::runNew($r);
                     $msj = true;
                  } else if($contenido->fecha_ampliada >= $fecha_actual) {
                     ContenidoRespuesta::runNew($r);
                     $msj = true;
                  } else {

                    $contenidoprogra = ContenidoProgramacion::where('contenido_id', '=', $r->contenido_id)
                                                  ->where('estado','=', 1)
                                                  ->first();
                    if (count($contenidoprogra) == 0)
                        $msj = false;
                    else
                    {
                        if($contenidoprogra->fecha_ampliacion >= $fecha_actual) {
                            ContenidoRespuesta::runNew($r);
                            $msj = true;
                        }else {
                            $msj = false;
                        }
                    }
                  }

                  if($msj == true){
                    $return['rst'] = 1;
                    $return['msj'] = 'Registro creado';
                  }else {
                    $return['rst'] = 3;
                    $return['msj'] = 'No se puede grabar debido a su fecha de Tiempo Final!';
                  }
                  //--
              }


             }
             else
             {
                 $return['rst'] = 2;
                 $return['msj'] = $validator->errors()->all()[0];
             }
             return response()->json($return);
         }
     }

     public function EditStatus(Request $r )
     {
         if ( $r->ajax() ) {
             ContenidoRespuesta::runEditStatus($r);
             $return['rst'] = 1;
             $return['msj'] = 'Registro actualizado';
             return response()->json($return);
         }
     }

     public function guardarNotaRpta(Request $r )
     {
         if ( $r->ajax() ) {
             ContenidoRespuesta::guardarNotaRpta($r);
             $return['rst'] = 1;
             $return['msj'] = 'Registro actualizado';
             return response()->json($return);
         }
     }

}

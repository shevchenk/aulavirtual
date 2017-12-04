<?php
namespace App\Http\Controllers\Proceso;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Proceso\Contenido;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ContenidoPR extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  //Esto debe activarse cuando estemos con sessión
    }

    public function EditStatus(Request $r )
    {
        if ( $r->ajax() ) {
            Contenido::runEditStatus($r);
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
                'curso_id' =>
                       ['required',
                        ],
            );


            $validator=Validator::make($r->all(), $rules,$mensaje);

            if ( !$validator->fails() ) {
                Contenido::runNew($r);
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
                'curso_id' =>
                       ['required',
                        ],
            );

            $validator=Validator::make($r->all(), $rules,$mensaje);

            if ( !$validator->fails() ) {
                Contenido::runEdit($r);
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
            $renturnModel = Contenido::runLoad($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);
        }
    }

    // --
    public function LoadContenidoProgra(Request $r )
    {
        if ( $r->ajax() ) {
            $renturnModel = Contenido::runLoadContenidoProgra($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);
        }
    }
    // --
    
       public function NewCopiaContenido(Request $r )
    {
        if ( $r->ajax() ) {

            $mensaje= array(
                'required'    => ':attribute es requerido',
                'unique'      => ':attribute solo debe ser único',
            );

            $rules = array(
                'programacion_unica_id' =>
                       ['required',
                        ],
            );


            $validator=Validator::make($r->all(), $rules,$mensaje);

            if ( !$validator->fails() ) {
                Contenido::runNewCopiaContenido($r);
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

}

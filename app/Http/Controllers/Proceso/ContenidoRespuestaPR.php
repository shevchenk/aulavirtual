<?php
namespace App\Http\Controllers\Proceso;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Proceso\ContenidoRespuesta;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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



}

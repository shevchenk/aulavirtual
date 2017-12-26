<?php
namespace App\Http\Controllers\Mantenimiento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mantenimiento\Balotario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PDF;
use App\Models\Mantenimiento\BalotarioPregunta;

class BalotarioEM extends Controller
{
    public function __construct()
    {
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
    
    public function GenerateBallot(Request $r ){
        if ( $r->ajax() ) {
            
            $rst=Balotario::runGenerateBallot($r);
            
            if($rst==1){
                $return['msj'] = 'Balotario Generado';
            }else{
                $return['msj'] = 'Balotario no Generado por falta de preguntas';
            }
            
            $return['rst'] = $rst;
            return response()->json($return);
        }
    }
    
    public function GenerarPDF(Request $r) {

        $renturnModel = BalotarioPregunta::runLoad($r);
        
        $preguntas = array();
        foreach ($renturnModel as $data) {
        $pregunta = $data->pregunta;
            if (isset($preguntas[$pregunta])) {
                $preguntas[$pregunta][] = $data;
            } else {
                $preguntas[$pregunta] = array($data);
            }
        }
        
        $data = ['preguntas' => $preguntas];

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

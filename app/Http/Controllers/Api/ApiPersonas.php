<?php
namespace App\Http\Controllers\Api;

//use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Api\Personas;

class ApiPersonas extends Controller
{
    //use WithoutMiddleware;

    public function __construct()
    {
        //$this->middleware('auth');  //Esto debe activarse cuando estemos con sessión
    }

    public function index(){
        //
    }

    public function store()
    {
        $obj = json_decode( file_get_contents('php://input') );
        $objArr = (array)$obj;

        if (empty($objArr))
            $this->response(422,"error","Ingrese sus datos de envio");
        else
        {
          $val = $this->insertPersona($objArr);
          if($val == true)
              $this->response(200,"success","Proceso ejecutado satisfactoriamente");
          else
              $this->response(422,"error","Revisa tus parametros de envio");
        }
    }

    public function response($code=200, $status="", $message="")
    {
        http_response_code($code);
        if( !empty($status) && !empty($message) )
        {
            $response = array(
                        "status" => $status ,
                        "message"=>$message,
                        "server" => $_SERVER['REMOTE_ADDR']
                    );
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    }


    public function insertPersona($objArr)
    {
        DB::beginTransaction();
        try
        {
            foreach ($objArr['personas'] as $k=>$value)
            {
                $personas = Personas::where('dni', '=', trim($value->dni))
                                    ->where('paterno', '=', trim($value->paterno))
                                    ->where('materno', '=', trim($value->materno))
                                    ->where('nombre', '=', trim($value->nombre))
                                    ->where('persona_externo_id', '=', trim($value->persona_externo_id))
                                    ->first();

                if (count($personas) == 0)
                {
                    // Graba datos
                    $obj = new Personas;
                    $obj->dni = trim( $value->dni );
                    $obj->paterno = trim( $value->paterno );
                    $obj->materno = trim( $value->materno );
                    $obj->nombre = trim( $value->nombre );
                    $obj->persona_externo_id = trim( $value->persona_externo_id );
                    $obj->estado = 1;
                    $obj->persona_id_created_at=1;
                    $obj->save();
                    // --
                }
            }
            $msg = true;
            DB::commit();
        }
        catch (\Exception $e)
        {
            $msg = false;
            DB::rollback();
        }
        return $msg;
    }


}

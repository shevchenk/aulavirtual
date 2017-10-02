<?php
namespace App\Http\Controllers\Api;

//use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Api\Curso;

class ApiCurso extends Controller
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
        {
            $this->response(422,"error","Ingrese sus datos de envio");
        }
        else if(isset($obj->key[0]->id) && isset($obj->key[0]->token))
        {
            $tab_cli = DB::table('clientes_accesos')->select('id', 'nombre', 'key', 'url', 'ip')
                                                    ->where('id','=', $obj->key[0]->id)
                                                    ->where('key','=', $obj->key[0]->token)
                                                    ->where('url','=', $obj->key[0]->url)
                                                    ->where('ip','=', $obj->key[0]->ip)
                                                    ->first();

            if($obj->key[0]->id == @$tab_cli->id && $obj->key[0]->token == @$tab_cli->key && $obj->key[0]->url == @$tab_cli->url && $obj->key[0]->ip == @$tab_cli->ip)
            {
                $val = $this->insertCurso($objArr);
                if($val == true)
                    $this->response(200,"success","Proceso ejecutado satisfactoriamente");
                else
                    $this->response(422,"error","Revisa tus parametros de envio");
            }
            else
            {
                $this->response(422 ,"error","Su Key no es valido");
            }
        }
        else
        {
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

    public function insertCurso($objArr)
    {
        DB::beginTransaction();
        try
        {
            foreach ($objArr['cursos'] as $k=>$value)
            {
                $cursos = Curso::where('curso', '=', trim($value->curso))
                                    ->where('curso_externo_id', '=', trim($value->curso_externo_id))
                                    ->first();

                if (count($cursos) == 0)
                {
                    // Graba datos
                    $obj = new Curso;
                    $obj->curso = trim( $value->curso );
                    $obj->curso_externo_id = trim( $value->curso_externo_id );
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
       
    public function Validaracceso(Request $r )
    { 
        $ruta='api.curso.curso';
        $valores['valida_ruta_url'] = $ruta;
        
        if (empty($r))
        {
            $valores['mensaje']='Ingrese sus datos de envio';
        }
        else if( $r->has('id') && $r->has('dni') )
        { 
            $tab_cli = DB::table('clientes_accesos')->where('id','=',$r->id)
                                                    ->first();
            if( count($tab_cli)==0 ){
                $valores['mensaje']=' Error de registro';
            }
            else {
            $key=$this->Curl('localhost/Cliente/CCurso.php?action=key');
            $valores['mensaje']=$key." =>BD ".$tab_cli->key;
//            if($obj->key[0]->id == @$tab_cli->id && $obj->key[0]->token == @$tab_cli->key && $obj->key[0]->url == @$tab_cli->url && $obj->key[0]->ip == @$tab_cli->ip)
//            {
//                $val = $this->insertCurso($objArr);
//                if($val == true)
//                     $valores['mensaje']='Proceso ejecutado satisfactoriamente';
//                else
//                    $valores['mensaje']='Revisa tus parametros de envio';      
//            }
//            else
//            {
//                $valores['mensaje']='Su Key no es valido';
//            }
            }
        }
        else
        {
            $valores['mensaje']='Revisa tus parametros de envio';
        }
//        return redirect($ruta)->with($valores);
        return view($ruta)->with($valores);

    }
    
    public function Curl($url,$data=array()){
                
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        //curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result);
    }

}

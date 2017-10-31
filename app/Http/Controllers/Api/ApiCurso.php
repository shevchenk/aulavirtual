<?php
namespace App\Http\Controllers\Api;

//use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Api\Curso;
//use App\Models\Mantenimiento\Persona;

// Auth
//use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\SecureAccess\Persona;

class ApiCurso extends Controller
{
    //use WithoutMiddleware;
    use AuthenticatesUsers;
    //use Session;

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
                        "message" => $message,
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
        $ruta = 'api.curso.curso';
        $valores['valida_ruta_url'] = $ruta;

        if (empty($r))
        {
            $valores['mensaje'] = 'Ingrese sus datos de envio';
        }
        else if( $r->has('id') && $r->has('dni') &&  $r->has('cargo'))
        {
            $tab_cli = DB::table('clientes_accesos')->where('id','=',$r->id)
                                                    ->first();
            if(count($tab_cli) == 0)
                $valores['mensaje'] = 'ID Cliente no Registrado!';
            else
            {
              $key = $this->curl('localhost/Cliente/CCurso.php?action=key');
              
              if($key->key == $tab_cli->key) // Se iguala el KEY del Cliente con el Key del Servidor
              {
                  $persona = DB::table('personas')->where('dni','=',$r->dni)
                                                  ->first();
                  if($persona)
                  {
                      //$priv_cliente = DB::table('privilegios_clientes')::find($r->cargo);
                      $priv_cliente = DB::table('privilegios_clientes')->where('id','=',$r->cargo)
                                                      ->first();

                      $privilegios_suc = DB::table('personas_privilegios_sucursales')
                                        ->where('persona_id','=',$persona->id)
                                        ->where('privilegio_id','=',$priv_cliente->id_priv_interno)
                                        ->first();

                      DB::table('personas_privilegios_sucursales')
                          ->where('persona_id', $persona->id)->update(['estado' => 0]);

                      if(count($privilegios_suc) > 0)
                      {
                        DB::table('personas_privilegios_sucursales')
                            ->where('persona_id', $persona->id)
                            ->where('privilegio_id', $r->cargo)
                            ->update(['estado' => 1]);
                      }
                      else
                      {
                        DB::table('personas_privilegios_sucursales')->insert([
                                  ['persona_id' => $persona->id,
                                    'privilegio_id' =>  $r->cargo,
                                    'estado' => 1,
                                    'created_at' => date("Y-m-d H:i:s"),
                                    'persona_id_created_at' => 1]
                              ]);
                      }
                       // Auth User
                       Auth::loginUsingId($persona->id);
                       $this->logeo($r->dni);
                       return redirect('secureaccess.inicio');
                       // --
                  }
                  else // Nueva Persona
                  {
                      $lista = $this->curl('localhost/Cliente/CCurso.php?key='.$key->key.'&dni='.$r->dni);

                      $pe = new Persona;
                      $pe->dni = $r->dni;
                      $pe->paterno = $lista->paterno;
                      $pe->materno = $lista->materno;
                      $pe->sexo = $lista->sexo;
                      $pe->nombre = $lista->nombre;
                      $pe->password = bcrypt($r->dni);
                      $pe->persona_id_created_at = 1;
                      $pe->save();

                      // Proceso de Carga de Opciones y Privilegios
                      $priv_cliente = DB::table('privilegios_clientes')->where('id','=',$r->cargo)
                                                      ->first();

                      $privilegios_suc = DB::table('personas_privilegios_sucursales')
                                        ->where('persona_id','=',$pe->id)
                                        ->where('privilegio_id','=',$priv_cliente->id_priv_interno)
                                        ->first();

                      DB::table('personas_privilegios_sucursales')
                          ->where('persona_id', $pe->id)->update(['estado' => 0]);

                      if(count($privilegios_suc) > 0)
                      {
                        DB::table('personas_privilegios_sucursales')
                            ->where('persona_id', $pe->id)
                            ->where('privilegio_id', $r->cargo)
                            ->update(['estado' => 1]);
                      }
                      else
                      {
                        DB::table('personas_privilegios_sucursales')->insert([
                                  ['persona_id' => $pe->id,
                                    'privilegio_id' =>  $r->cargo,
                                    'estado' => 1,
                                    'created_at' => date("Y-m-d H:i:s"),
                                    'persona_id_created_at' => 1]
                              ]);
                      }
                      Auth::loginUsingId($pe->id);
                      $this->logeo($r->dni);
                      return redirect('secureaccess.inicio');
                      // --
                  }
              }
              else
                $valores['mensaje'] = 'Su Key no es valido';
            }
        }
        else
        {
            $valores['mensaje'] = 'Revisa tus parametros de envio';
        }
        return view($ruta)->with($valores);
    }


    public function logeo($dni)
    {
        $menu = Persona::Menu();
        $opciones=array();
        foreach ($menu as $key => $value) {
            array_push($opciones, $value->opciones);
        }
        $opciones=implode("||", $opciones);
        $session= array(
            'menu'=>$menu,
            'opciones'=>$opciones,
            'dni'=>$dni
        );
        session($session);
        return true;
    }

    public function curl($url, $data=array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }

}
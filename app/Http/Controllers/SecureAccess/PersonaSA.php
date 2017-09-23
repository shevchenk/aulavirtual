<?php
namespace App\Http\Controllers\SecureAccess;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\SecureAccess\Persona;

class PersonaSA extends Controller
{
    use AuthenticatesUsers;

    protected $loginView = 'secureaccess.login';

    public function authenticated(Request $r)
    {
        $result['rst']=1;
        $menu = Persona::Menu();
        $opciones=array();
        foreach ($menu as $key => $value) {
            array_push($opciones, $value->opciones);
        }
        $opciones=implode("||", $opciones);
        $session= array(
            'menu'=>$menu,
            'opciones'=>$opciones,
            'dni'=>$r->dni
        );
        session($session);
        return response()->json($result);
    }

    public function username()
    {
        return "dni";
    }

    public function EditPassword(Request $r)
    {
        if ( $r->ajax() ) {
            if( $r->password == $r->password_confirm ){
                $rs=Persona::runEditPassword($r);
                $return['rst'] = 1;
                $return['msj'] = 'Registro actualizado';
                if( $rs==2 ){
                    $return['rst'] = 2;
                    $return['msj'] = 'Contraseña Actual no válida';
                }
            }
            else{
                $return['rst'] = 2;
                $return['msj'] = 'Contraseña y Contraseña de confirmación no '.
                'son iguales';
            }
            return response()->json($return);
        }
    }

    
}

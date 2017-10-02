<?php
// Rutas de Servicios Rest.
Route::resource('personas', 'Api\ApiPersonas',
                ['only' => ['index', 'store', 'update', 'destroy', 'show']]);

Route::resource('cursos', 'Api\ApiCurso',
                ['only' => ['index', 'store', 'update', 'destroy', 'show']]);
// --

//Route::controller('curso', 'Mantenimiento/CursoEM');

Route::get('/', function () {
    return view('secureaccess.login');
});

Route::get('/salir','SecureAccess\PersonaSA@logout');

Route::get(
    '/{ruta}', function ($ruta) {
        if( session()->has('dni') && session()->has('menu')
            && session()->has('opciones')
        ){
            $valores['valida_ruta_url'] = $ruta;
            $valores['menu'] = session('menu');

            if( strpos( session('opciones'),$ruta )!==false
                || $ruta=='secureaccess.inicio'
                || $ruta=='secureaccess.myself' ){
                return view($ruta)->with($valores);
            }
            else{
                return redirect('secureaccess.inicio');
            }
        }
        else{
            return redirect('/');
        }
    }
);

Route::get('/ReportDinamic/{ruta}','SecureAccess\PersonaSA@Menu');
Route::post('/AjaxDinamic/{ruta}','SecureAccess\PersonaSA@Menu');

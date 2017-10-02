<?php
namespace App\Http\Controllers\Mantenimiento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mantenimiento\Opcion;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CursoEM extends Controller
{
    public function __construct()
    {
    //    $this->middleware('auth');  //Esto debe activarse cuando estemos con sessión
    } 

}

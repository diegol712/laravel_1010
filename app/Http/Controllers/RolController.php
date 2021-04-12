<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;

class RolController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');  //Si la petición se hace sin ajax envía al navegador principal
        $roles = Rol::orderBy('id','desc')->get();
        return $roles;
    }
}

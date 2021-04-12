<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        $this->validate($request,[          //Validar si los datos son correctos
            'email' => 'required|string',
            'password' => 'required|string'

        ]);

        //Verificar si el usuario está autenticado
        /*if (Auth::attempt(['name' => $request->usuario,'password' => $request->password, 'condicion' => 1])){
           return redirect()->route('main');
        }*/
        var_dump(Hash::make($request->password));
        //var_dump(Auth::attempt(['name' => $request->usuario,'password' => $request->password]));
        if (Auth::attempt(['email' => $request->email,'password' => $request->password])){
            //var_dump($request->usuario);
            return redirect()->route('main');
         }
        return back()->withErrors(['email' => trans('auth.failed')]);
        //trans traducir
    }

    function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}

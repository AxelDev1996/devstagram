<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6|alpha_num'
        ]);

        //Validando que los datos de login sean correctos.
        if(!auth()->attempt($request->only('email', 'password'), $request->remember)){
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        return redirect()->route('post.index', auth()->user()->username);
    }
}

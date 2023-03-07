<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){
        //dd($request);
        // dd($request->get('username'));


        //Validacion.
        $this->validate($request, [
            'name' => 'required|min:2|max:30|alpha_num',
            'username' => 'required|unique:users|min:3|max:20|alpha_num',
            'email' => 'required|email|unique:users|max:60',
            'password' => 'required|confirmed|min:6|alpha_num'
        ]);

        dd('creando usuario..');
    }
}

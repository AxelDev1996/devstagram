<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    //
    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){
        //dd($request);
        // dd($request->get('username'));


        $request->request->add(['username' => Str::slug($request->username)]);

        //Validacion.
        $this->validate($request, [
            'name' => 'required|min:2|max:30|alpha_num',
            'username' => 'required|unique:users|min:3|max:20|alpha_num',
            'email' => 'required|email|unique:users|max:60',
            'password' => 'required|confirmed|min:6|alpha_num'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        //Autenticar al Usuario.
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        //Otra forma de autenticar
        auth()->attempt($request->only('email', 'password'));



        //Redireccionar
        return redirect()->route('post.index');
    }
}

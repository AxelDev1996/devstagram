<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;


class PerfilController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){

        $user = auth()->user();

        return view('perfil.index', [
            'user' => $user
        ]);
    }

    public function store(Request $request){

        $request->request->add(['username' => Str::slug($request->username)]);
        $usuario = User::find(auth()->user()->id);


        $this->validate($request, [
            'username' => ['required', 'alpha_num', 'min:3', 'max:20', 'unique:users,username,' . auth()->user()->id, 'not_in:login,logout,register,'],
            'email' => ['required', 'email', 'unique:users,email,' . auth()->user()->id],
            'password' => ['required_unless:new_password,null' ,'nullable' ,'min:6', 'alpha_num'],
            'new_password' => ['nullable', 'min:6', 'alpha_num']
        ]);

        if($request->imagen){
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . '.' . $imagen->extension();

            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);

            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }



        if(isset($request->new_password)){
            if(!auth()->attempt($request->only('email', 'password'))){
                return back()->with('mensaje', 'Contraseña Incorrecta');
            }

            $usuario->password = Hash::make($request->new_password);
        }


        //Guardar Cambios
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? '';
        $usuario->save();



        //Redireccionar al perfil del usuario ya modificado
        return redirect()->route('post.index', $usuario->username);
    }
}

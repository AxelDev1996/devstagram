<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, Post $post){

        //validar
        $this->validate($request, [
            'comentario' => 'max:255|required|min:3'
        ]);

        //almacenar el resultado
        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' =>$request->comentario
        ]);
        //imprimir un mensaje

        return back()->with('mensaje', 'Comentario publicado correctamente');
    }
}

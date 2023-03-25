<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    //Constructor.
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Funcion Invoke, sirve cuando no hay otras funciones en una clase, es el por defecto.
    public function __invoke()
    {
        //Obtener a quienes se esta siguiendo.
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);

        return view('home', [
            'posts'=>$posts
        ]);
    }
}

<div>
    @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div class="">
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]); }}">
                        <img src="{{asset('uploads') . '/' .  $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
                    </a>
                </div>
            @endforeach
        </div>

        <div class="my-10">
            {{$posts->links('pagination::tailwind')}}
        </div>
    @else
        <p class="text-center p-4 bg-slate-300 text-slate-700 font-bold border-dashed border-4 rounded ">No hay posts a mostrar, segui a mas usuarios para ver sus publicaciones aca.</p>
    @endif
</div>

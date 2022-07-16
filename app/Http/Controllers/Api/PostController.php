<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request) {
        $posts = Post::paginate($request->posts_per_page);

        // Creo l'url completo per l'immagine. Mi aiuto con la funzione url di laravel.
        // La funzione url restituisce il patch completo.
        foreach ($posts as $post) {
            if ($post->cover) {
                $post->cover = url('storage/' . $post->cover);
            }
        }

        return response()->json([
            'success' => true,
            'results' => $posts
        ]);
    }

    public function show($slug) {
        // Nel with vanno gli attributi delle tabelle collegate che ci interessano. Vedi il model per controllare che siano al singolare o al plurale (anche a logica).
        $post = Post::where('slug', '=', $slug)->with(['category', 'tags'])->first();

        if ($post->cover) {
            $post->cover = url('storage/' . $post->cover);
        }

        if($post) {
            return response()->json([
                'success' => true,
                'results' => $post
            ]);
        } else {
            return response()->json([
                'success' => false,
                'results' => 'Post non trovato'
            ]);
        }
    }
}

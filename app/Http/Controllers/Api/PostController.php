<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request) {
        $posts = Post::paginate($request->posts_per_page);
        return response()->json([
            'success' => true,
            'results' => $posts
        ]);
    }

    public function show($slug) {
        // Nel with vanno gli attributi delle tabelle collegate che ci interessano. Vedi il model per controllare che siano al singolare o al plurale (anche a logica).
        $post = Post::where('slug', '=', $slug)->with(['category', 'tags'])->first();
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

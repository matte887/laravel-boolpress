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
}

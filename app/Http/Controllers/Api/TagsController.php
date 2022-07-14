<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index() {
        $tags = Tag::all();
        return response()->json([
            'success' => true,
            'tags' => $tags
        ]);
    }

    public function show($slug) {
        $tags_posts = Tag::where('slug', '=', $slug)->with(['posts'])->first();
        if($tags_posts) {
            return response()->json([
                'success' => true,
                'tags_posts' => $tags_posts
            ]);
        } else {
            return response()->json([
                'success' => false,
                'tags_posts' => 'Questo tag non esiste'
            ]);
        }
    }
}

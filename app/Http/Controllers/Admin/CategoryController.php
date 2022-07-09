<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function show($slug) {
        $this_category = Category::where('slug', $slug)->first();
        $posts = $this_category->posts;
        return view('admin.categories.show', compact('this_category', 'posts'));
    }
}

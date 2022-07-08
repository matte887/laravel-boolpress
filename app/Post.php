<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'category_id',
        'content'
    ];

    // Questa è la tabella dipendente (per questo si usa belongsTo): ogni post ha solo una categoria, per questo la funzione si chiama "category".
    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function tags() {
        return $this->hasMany('App\Tag');
    }

    public static function generatePostSlug($title) {
        $basic_slug = Str::slug($title, '-');
        $slug = $basic_slug;
        $counter = 1;
        $search_post = Post::where('slug', $slug)->first();
        while ($search_post) {
            $slug = $basic_slug . '-' . $counter;
            $search_post = Post::where('slug', '=', $slug)->first();
            $counter++;
        }

        return $slug;
    }
}

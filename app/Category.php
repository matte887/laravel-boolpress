<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Quella delle categorie è la tabella principale, mentre quella dei post è la tabella dipendente.
    // Ogni categoria ha molti post, per questo la funzione si chiama "posts" e dentro si usa hasMany. 
    public function posts() {
        return $this->hasMany('App\Post');
    }
}

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('posts', 'Api\PostController@index')->name('api.posts.index');
Route::get('post/{slug}', 'Api\PostController@show')->name('api.post.show');

Route::get('tags/', 'Api\TagsController@index')->name('api.tags.index');
Route::get('tag/{slug}', 'Api\TagsController@show')->name('api.tag.show');
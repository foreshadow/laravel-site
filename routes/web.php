<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('article/{id}', function ($id) {
    $article = \App\Article::find($id);
    $user = \App\User::find($article->creator);
    return view('article/index', [
        'article' => $article,
        'user' => $user
    ]);
});

Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth', 
    'namespace' => 'Admin'
], function () {
    Route::get('/', 'HomeController@index');
    Route::resource('article', 'ArticleController');
});

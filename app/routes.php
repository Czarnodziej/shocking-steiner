<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// User Login/Logout
Route::get('wyloguj', array('as' => 'user.logout', 'uses' => 'App\Controllers\User\AuthController@getLogout'));
Route::get('zaloguj', array('as' => 'user.login', 'uses' => 'App\Controllers\User\AuthController@getLogin'));
Route::post('zaloguj', array('as' => 'user.login.post', 'uses' => 'App\Controllers\User\AuthController@postLogin'));

// User registration
Route::get('rejestracja', array('as' => 'user.register', 'uses' => 'App\Controllers\User\AuthController@getRegister'));
Route::post('rejestracja', array('as' => 'user.register.post', 'uses' => 'App\Controllers\User\AuthController@postRegister'));


// User CRUD
Route::group(array('prefix' => 'użytkownik', 'before' => 'auth.user'), function()
{
    Route::any('/', 'App\Controllers\User\ArticlesController@index');
    Route::resource('teksty', 'App\Controllers\User\ArticlesController');
});

// Article list
Route::any('/', array('as' => 'article.list', function()
{
    return View::make('articles.index')->with('entries', Article::orderBy('created_at', 'desc')->get());
}));

// Single article
Route::get('teksty/{slug}', array('as' => 'article', function($slug)
{
    $article = Article::where('slug', $slug)->first();

    if ( ! $article) App::abort(404, 'Artykuł nie został odnaleziony');

    return View::make('articles.article')->with('entry', $article);
}));
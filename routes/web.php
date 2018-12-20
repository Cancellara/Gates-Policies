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

use App\Post;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

Route::get('/', function () {
    return view('welcome');
});


/*
 *
 * if (Gate::denies('update', $post)) { // si el usuario conectado no tiene acceso para actualizar el post
    abort(403); // vamos a abortar la petición con un error 403
}
 */

//Route::put('admin/posts/{post}', 'Admin\PostController@update');//->middleware('can:update,post'); ////update es el método del policy y post el modelo que esta asociado.
Route::middleware('auth')->namespace('Admin\\')->prefix('admin/')->group(function () {
    Route::get('posts', 'PostController@index');
    Route::post('posts', 'PostController@store');
    Route::get('posts/{post}/edit', 'PostController@edit')->name('posts.edit');
    Route::put('posts/{post}', 'PostController@update');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

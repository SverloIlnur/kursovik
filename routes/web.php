<?php

use Illuminate\Support\Facades\Route;

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

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
*/
require __DIR__.'/auth.php';

Route::group(['namespace' => 'App\Http\Controllers'], function() {

    Route::get('/post/search', "PostController@search")->name('post.search');

    Route::get('/personal', "PersonalController@index")->middleware(['auth'])->name('personal');

    Route::patch('/personal/changename', "PersonalController@changename")->middleware(['auth'])->name('personal.changename');
    
    Route::patch('/personal/changeemail', "PersonalController@changeemail")->middleware(['auth'])->name('personal.changeemail');
    
    Route::patch('/personal/changepassword', "PersonalController@changepassword")->middleware(['auth'])->name('personal.changepassword');

    Route::get('/post', "PostController@index")->middleware(['auth'])->name('post');

    Route::patch('/post/create', "PostController@create")->middleware(['auth'])->name('post.create');

    Route::get('/post/{post}', "PostController@show")->name('post.show');

    Route::get('post/destroy/{post}', "PostController@destroy")->middleware(['auth'])->name('post.destroy');

    Route::get('post/edit/{post}', "PostController@edit")->middleware(['auth'])->name('post.edit');

    Route::put('post/update/{id}', "PostController@update")->middleware(['auth'])->name('post.update'); 

    Route::get('/admin', "RoleController@index")->middleware(['auth'])->name('admin');

    Route::put('admin/search_user', "RoleController@search_user")->middleware(['auth'])->name('admin.search_user');

    Route::put('admin/search_post', "RoleController@search_post")->middleware(['auth'])->name('admin.search_post');

    Route::put('admin/search_tag', "RoleController@search_tag")->middleware(['auth'])->name('admin.search_tag');

    Route::get('admin/user_destroy/{user}', "RoleController@user_destroy")->middleware(['auth'])->name('admin.user_destroy');

    Route::get('admin/post_destroy/{post}', "RoleController@post_destroy")->middleware(['auth'])->name('admin.post_destroy');

    Route::get('admin/tag_destroy/{tag}', "RoleController@tag_destroy")->middleware(['auth'])->name('admin.tag_destroy');

    Route::get('post/rating/{post}', "PostController@rating")->middleware(['auth'])->name('post.rating');

    Route::patch('post/comment/{post}', "PostController@comment")->middleware(['auth'])->name('post.comment');

    Route::get('post/{post}/comment/{comment}', "PostController@destroy_comment")->middleware(['auth'])->name('post.destroy_comment');

    Route::get('/', "DashboardController@index")->name('dashboard');

    Route::get('post/search_tag/{tag}', "PostController@search_tag")->name('post.search_tag');
});

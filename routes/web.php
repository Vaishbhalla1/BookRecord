<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers;
//use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use App\Models\Post;
use App\Mail\NewPost;
use Illuminate\Support\Facades\Mail;

Route::get('/dashboard', function(){
    return view('/dashboard');
})->name('dashboard');

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

/* Route::group(['middleware'=>['web']], function(){
    Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'App\Http\Controllers\BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');
    Route::get('/contact','App\Http\Controllers\PagesController@getContact');
    Route::get('/about','App\Http\Controllers\PagesController@getAbout');
    Route::get('/','App\Http\Controllers\PagesController@getIndex');
    Route::resource('posts','App\Http\Controllers\PostController');
}); */

View::composer('layouts.frontend.partials.sidebar', function ($view) {
    $categories = Category::all()->take(10);
    $recentTags = Tag::all();
    $recentPosts = Post::latest()->take(3)->get();
    return $view->with('categories', $categories)->with('recentPosts', $recentPosts)->with('recentTags', $recentTags);
});


Auth::routes();

Route::get('login/google', 'App\Http\Controllers\Auth\LoginController@redirectToProvider');
Route::get('login/google/callback', 'App\Http\Controllers\Auth\LoginController@handleProviderCallback');

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/posts', 'App\Http\Controllers\HomeController@posts')->name('posts');
Route::get('/categories', 'App\Http\Controllers\HomeController@categories')->name('categories');
Route::get('/post/{slug}', 'App\Http\Controllers\HomeController@post')->name('post');
Route::get('/category/{slug}', 'App\Http\Controllers\HomeController@categoryPost')->name('category.post');
Route::get('/search', 'App\Http\Controllers\HomeController@search')->name('search');
Route::get('/tag/{name}', 'App\Http\Controllers\HomeController@tagPosts')->name('tag.posts');
Route::post('/comment/{post}', 'App\Http\Controllers\CommentController@store')->name('comment.store');
Route::post('/comment-reply/{comment}', 'App\Http\Controllers\CommentReplyController@store')->name('reply.store')->middleware(['auth', 'verified']);
Route::post('/like-post/{post}', 'App\Http\Controllers\HomeController@likePost')->name('post.like')->middleware('auth');


// Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('profile', 'DashboardController@showProfile')->name('profile');
    Route::put('profile', 'DashboardController@updateProfile')->name('profile.update');
    Route::put('profile/password', 'DashboardController@changePassword')->name('profile.password');
    Route::resource('user', 'UserController')->except(['create', 'show', 'edit', 'store']);
    Route::resource('category', 'CategoryController')->except(['create', 'show', 'edit']);
    Route::resource('post', 'PostController');
    Route::get('/comments', 'CommentController@index')->name('comment.index');
    Route::delete('/comment/{id}', 'CommentController@destroy')->name('comment.destroy');
    Route::get('/reply-comments', 'CommentReplyController@index')->name('reply-comment.index');
    Route::delete('/reply-comment/{id}', 'CommentReplyController@destroy')->name('reply-comment.destroy');
    Route::get('/post-liked-users/{post}', 'PostController@likedUsers')->name('post.like.users');
});
// User
Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'App\Http\Controllers\User', 'middleware' => ['auth', 'user']], function () {
    Route::get('dashboard', 'DashboardController@likedPosts')->name('dashboard');
    Route::get('profile', 'DashboardController@showProfile')->name('profile');
    Route::put('profile', 'DashboardController@updateProfile')->name('profile.update');
    Route::put('profile/password', 'DashboardController@changePassword')->name('profile.password');
    Route::get('comments', 'CommentController@index')->name('comment.index');
    Route::delete('/comment/{id}', 'CommentController@destroy')->name('comment.destroy');
    Route::get('/reply-comments', 'CommentReplyController@index')->name('reply-comment.index');
    Route::delete('/reply-comment/{id}', 'CommentReplyController@destroy')->name('reply-comment.destroy');
    Route::get('/user-liked-posts', 'DashboardController@likedPosts')->name('like.posts');
    
});

Route::get('/send', function(){
    $post = Post::findOrFail(4);
    // Send Mail
    Mail::to('user@example.com')->send(new NewPost($post));
      //  ->queue(new NewPost($post));

    return (new App\Mail\NewPost($post))->render();
});

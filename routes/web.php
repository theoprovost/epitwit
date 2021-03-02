<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('timeline','App\Http\Controllers\Api\Timeline\TimelineController@index');
Route::get('api/notifications','App\Http\Controllers\Api\Notifications\NotificationController@index');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/notifications', 'App\Http\Controllers\Notifications\NotificationController@index');

Route::get('/tweets/{tweet}', 'App\Http\Controllers\Tweets\TweetController@show');

Route::get('/{username}', 'App\Http\Controllers\Users\UserController@index');

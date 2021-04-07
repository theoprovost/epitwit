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

Route::get('/explore', [App\Http\Controllers\ExploreController::class, 'index']);
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index']);

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/timeline', [App\Http\Controllers\Api\Timeline\TimelineController::class, 'index']);
Route::get('api/notifications', [App\Http\Controllers\Api\Notifications\NotificationController::class , 'index']);
Route::get('/notifications', [App\Http\Controllers\Notifications\NotificationController::class, 'index']);

Route::get('/tweets/{tweet}', [App\Http\Controllers\Tweets\TweetController::class, 'show']);

Route::get('/messages', [App\Http\Controllers\ConversationPanelController::class, 'index']);
Route::get('/api/messages/{authId}-{userId}', [App\Http\Controllers\Api\Conversations\ConversationController::class, 'index']);
Route::get('/messages/{authId}-{userId}', [App\Http\Controllers\ConversationController::class, 'index']);


Route::get('/{username}', [App\Http\Controllers\Users\UserController::class, 'index']);
Route::get('/{username}/followers', [App\Http\Controllers\Users\FollowersController::class, 'index']);
Route::get('/{username}/following', [App\Http\Controllers\Users\FollowingController::class, 'index']);

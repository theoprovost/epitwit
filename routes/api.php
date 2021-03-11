<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/timeline', [App\Http\Controllers\Api\Timeline\TimelineController::class, 'index']);
Route::get('/timeline/{user}', [App\Http\Controllers\Api\Timeline\TimelineController::class, 'user_index']);

Route::post('/tweets', [App\Http\Controllers\Api\Tweets\TweetController::class, 'store']);
Route::get('/tweets', [App\Http\Controllers\Api\Tweets\TweetController::class, 'index']);


Route::post('/tweets/{tweet}/likes', [App\Http\Controllers\Api\Tweets\TweetLikeController::class, 'store']);
Route::delete('/tweets/{tweet}/likes', [App\Http\Controllers\Api\Tweets\TweetLikeController::class, 'destroy']);

Route::post('/tweets/{tweet}/retweets', [App\Http\Controllers\Api\Tweets\TweetRetweetController::class, 'store']);
Route::delete('/tweets/{tweet}/retweets', [App\Http\Controllers\Api\Tweets\TweetRetweetController::class, 'destroy']);

Route::post('/tweets/{tweet}/quotes', [App\Http\Controllers\Api\Tweets\TweetQuoteController::class, 'store']);

Route::get('/media/types', [App\Http\Controllers\Api\Media\MediaTypesController::class, 'index']);
Route::post('/media', [App\Http\Controllers\Api\Media\UploadController::class , 'store']);

Route::get('/notifications', [App\Http\Controllers\Api\Notifications\NotificationController::class, 'index']);

Route::get('/tweets/{tweet}/replies',[App\Http\Controllers\Api\Tweets\TweetReplyController::class, 'show']);
Route::post('/tweets/{tweet}/replies',[App\Http\Controllers\Api\Tweets\TweetReplyController::class, 'store']);

Route::post('/tweets/{user_id}/follow', [App\Http\Controllers\Api\Users\UserFollowController::class, 'store']);
Route::delete('/tweets/{user_id}/follow', [App\Http\Controllers\Api\Users\UserFollowController::class, 'destroy']);

Route::get('/tweets/{tweet}', [App\Http\Controllers\Api\Tweets\TweetController::class, 'show']);
Route::delete('/tweets/{tweet}', [App\Http\Controllers\Api\Tweets\TweetController::class, 'destroy']);
Route::post('/submit', [App\Http\Controllers\EditProfileFormController::class, 'submit']);


Route::get('/messages', [App\Http\Controllers\Api\Conversations\ConversationPanelController::class, 'index']);

Route::post('/explore/search', [App\Http\Controllers\Api\Explore\HashtagController::class, 'find']);
Route::post('/users/search', [App\Http\Controllers\Api\Explore\UserController::class, 'find']);
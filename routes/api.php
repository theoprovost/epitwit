<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/timeline','App\Http\Controllers\Api\Timeline\TimelineController@index');

Route::post('/tweets','App\Http\Controllers\Api\Tweets\TweetController@store');
Route::get('/tweets/{tweet}','App\Http\Controllers\Api\Tweets\TweetController@index');
Route::get('/tweets','App\Http\Controllers\Api\Tweets\TweetController@show');


Route::post('/tweets/{tweet}/likes','App\Http\Controllers\Api\Tweets\TweetLikeController@store');
Route::delete('/tweets/{tweet}/likes','App\Http\Controllers\Api\Tweets\TweetLikeController@destroy');

Route::post('/tweets/{tweet}/retweets','App\Http\Controllers\Api\Tweets\TweetRetweetController@store');
Route::delete('/tweets/{tweet}/retweets','App\Http\Controllers\Api\Tweets\TweetRetweetController@destroy');

Route::post('/tweets/{tweet}/quotes','App\Http\Controllers\Api\Tweets\TweetQuoteController@store');

Route::get('/media/types', 'App\Http\Controllers\Api\Media\MediaTypesController@index');
Route::post('/media', 'App\Http\Controllers\Api\Media\UploadController@store');

Route::get('/notifications', 'App\Http\Controllers\Api\Notifications\NotificationController@index');

Route::post('/tweets/{tweet}/replies','App\Http\Controllers\Api\Tweets\TweetReplyController@store');

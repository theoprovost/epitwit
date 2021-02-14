<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/timeline','App\Http\Controllers\Api\Timeline\TimelineController@index');
Route::post('/tweets','App\Http\Controllers\Api\Tweets\TweetController@store');

Route::post('/tweets/{tweet}/likes','App\Http\Controllers\Api\Tweets\TweetLikeController@store');
Route::delete('/tweets/{tweet}/likes','App\Http\Controllers\Api\Tweets\TweetLikeController@destroy');

Route::post('/tweets/{tweet}/retweets','App\Http\Controllers\Api\Tweets\TweetRetweetController@store');
Route::delete('/tweets/{tweet}/retweets','App\Http\Controllers\Api\Tweets\TweetRetweetController@destroy');

Route::get('/media/types', 'App\Http\Controllers\Api\Media\MediaTypesController@index');
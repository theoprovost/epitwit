<?php

namespace App\Http\Controllers\Api\Media;

use App\Models\TweetMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Media\MediaStoreRequest;
use App\Http\Resources\TweetMediaCollection;

class UploadController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:sanctum');
    }

    public function store(MediaStoreRequest $request)
    {
        $createdMedia = collect($request->media)->map(function($media) {
            return $this->addMedia($media);
        }); // Create a collection from the given value.

        return new TweetMediaCollection($createdMedia);
    }

    public function addMedia($media)
    {
        $tweetMedia = TweetMedia::create([]); // empty record in DB (tweet_media table)

        $tweetMedia->baseMedia()
            ->associate($tweetMedia->addMedia($media)->toMediaCollection()) // $tweetMedia->addMedia($media)->toMediaCollection() creates a record in Media table : methods from MediaLibrary Package
            ->save(); // saves it (to tweet_media table) : relations

        return $tweetMedia;
    }
}

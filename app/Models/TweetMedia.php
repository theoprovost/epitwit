<?php

namespace App\Models;


use Spatie\MediaLibrary\HasMedia;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
// Cf. doc (https://spatie.be/docs/laravel-medialibrary/v9/converting-images/defining-conversions#) : v.9

class TweetMedia extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public function baseMedia()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }
}

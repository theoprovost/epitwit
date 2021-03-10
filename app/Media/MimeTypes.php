<?php

namespace App\media;

class MimeTypes
{
    public static $images = [
        'image/png',
        'image/jpeg',
        'image/jpg',
        'image/gif',
    ];

    public static $video = [
        'video/mp4',
        'video/mov',
        'video/quicktime'
    ];

    static public function all()
    {
        return array_merge(self::$images, self::$video);
    }
}
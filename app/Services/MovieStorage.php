<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;


class MovieStorage {

    public static function storeMovieImg($file)
    {
        $path =  $file->store('public/movies');
        return $path;
    }

    public static function deleteMovieImg($filePath)
    {
        return Storage::delete($filePath);
    }
}

<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;


class MovieStorage {

    public static function storeMovieImg($file):string
    {
        $path =  $file->store('public/movies');
        return $path;
    }

    public static function deleteMovieImg(string $filePath)
    {
        return Storage::delete($filePath);
    }
}

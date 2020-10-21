<?php
namespace App\Services;



class FileService {

    public static function store($file, $movie_id, $path, $imgURL)
    {
        $file->movie_id = $movie_id; 
        $file->name = $path;
        $file->publicURL = $imgURL; 
        $id = $file->save();
        return $id;
    }

}

<?php
namespace App\Services;



class FileService {
    
    /**
     * store
     *
     * @param  object $file
     * @param  int $movie_id
     * @param  string $path
     * @param  string $imgURL
     * @return bool
     */
    public static function store($file, $movie_id, $path, $imgURL):bool
    {
        $file->movie_id = $movie_id; 
        $file->name = $path;
        $file->publicURL = $imgURL; 
        $result = $file->save();
        return $result;
    }

    public static function update($file, $path, $imgURL):bool
    {
        $file->name = $path;
        $file->publicURL = $imgURL; 
        $result = $file->save();
        return $result;
    }

}

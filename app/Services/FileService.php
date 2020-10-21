<?php
namespace App\Services;

use App\Models\File;



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
    public static function store(File $file, int $movie_id, string $path, string $imgURL):bool
    {
        $file->movie_id = $movie_id; 
        $file->name = $path;
        $file->publicURL = $imgURL; 
        $result = $file->save();
        return $result;
    }
    
    /**
     * update
     *
     * @param  object $file
     * @param  string $path
     * @param  string $imgURL
     * @return bool
     */
    public static function update(File $file, string $path, string $imgURL):bool
    {
        $file->name = $path;
        $file->publicURL = $imgURL; 
        $result = $file->save();
        return $result;
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MovieGenre;
use App\Models\Genre;
use App\Models\File;

class Movie extends Model
{
    use HasFactory;
    protected $table="movies";
    protected $fillable =['name', 'description','img','imgURL', 'released_at'];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function files()
    {
        return $this->hasOne(File::class);
    }

}

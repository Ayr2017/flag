<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GenreController extends Controller
{
    public function getGenres()
    {
        $genres = DB::table('genres')->select('id as value', 'name as text')->get();
        return $genres->toJson();
    }

}

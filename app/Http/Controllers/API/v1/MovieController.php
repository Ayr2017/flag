<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\Movie;
// use App\Models\MovieGenre;
use App\Services\MovieService;
// use App\Services\MovieStorage;
// use Illuminate\Database\Eloquent\ModelNotFoundException;
// use Illuminate\Http\Response;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Str;

class MovieController extends Controller
{
    public function getMovies(Request $request)
    {
        return MovieService::getMovies($request);
    }

    public function getMovieById($id)
    {
        return MovieService::getMovieById($id);
    }

    public function getMoviesByGenre($id)
    {
        return MovieService::getMoviesByGenre($id);
    }

    public function store(Request $request)
    {
        $result = MovieService::storeMovie($request);
        if(!$result) return response('Created successfully', 200)->header('Content-Type', 'text/plain');
    }

    public function destroy($id)
    {
        return MovieService::destroyMovie($id);
    }

    public function update(Request $request)
    {
        $result =  MovieService::updateMovie($request);
        if($result) return response('Updated successfully', 201)->header('Content-Type', 'text/plain');
    }
}

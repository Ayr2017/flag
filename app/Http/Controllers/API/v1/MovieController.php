<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MovieService;

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
        if(!$result) return response('Created successfully', 201)->header('Content-Type', 'text/plain');
    }

    public function destroy($id)
    {
        $result =  MovieService::destroyMovie($id);
        if($result) return response('Deleted successfully', 200)->header('Content-Type', 'text/plain');
    }

    public function update(Request $request)
    {
        $result =  MovieService::updateMovie($request);
        if($result) return response('Updated successfully', 200)->header('Content-Type', 'text/plain');
    }
}

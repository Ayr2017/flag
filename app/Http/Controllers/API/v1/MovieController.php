<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;
use App\Services\MovieService;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        return MovieService::getMovies($request);
    }

    public function show(Movie $movie)
    {
        return MovieService::getMovieById($movie->id);
    }

    public function getMoviesByGenre(Genre $genre)
    {
        return MovieService::getMoviesByGenre($genre->id);
    }

    public function store(Request $request)
    {
        $result = MovieService::storeMovie($request);
        if(!$result) return response()->json(['Message'=>'Created successfully'], 201);
    }

    public function destroy(Movie $movie)
    {
        $result =  MovieService::destroyMovie($movie->id);
        if($result) return response()->json(['Message'=>'Deleted successfully'], 200);
    }

    public function update(Request $request)
    {
        $result =  MovieService::updateMovie($request);
        if($result) return response()->json(['Message'=>'Updated successfully'], 200);
    }
}

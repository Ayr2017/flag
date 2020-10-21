<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;
use App\Services\MovieService;

class MovieController extends Controller
{        
    /**
     * index
     *
     * @param  Request $request
     * @return object
     */
    public function index(Request $request):object
    {
        return MovieService::getMovies($request);
    }
    
    /**
     * show
     *
     * @param  Movie $movie
     * @return object
     */
    public function show(Movie $movie):object
    {
        return MovieService::getMovieById($movie->id);
    }
    
    /**
     * getMoviesByGenre
     *
     * @param  Genre $genre
     * @return object
     */
    public function getMoviesByGenre(Genre $genre):object
    {
        return MovieService::getMoviesByGenre($genre->id);
    }
    
    /**
     * store
     *
     * @param  Request $request
     * @return object
     */
    public function store(Request $request):object
    {
        $result = MovieService::storeMovie($request);
        if(!$result) return response()->json(['Message'=>'Created successfully'], 201);
    }
    
    /**
     * destroy
     *
     * @param  Movie $movie
     * @return object
     */
    public function destroy(Movie $movie):object
    {
        $result =  MovieService::destroyMovie($movie->id);
        if($result) return response()->json(['Message'=>'Deleted successfully'], 200);
    }
    
        
    /**
     * update
     *
     * @param  mixed $request
     * @return object
     */
    public function update(Request $request):object
    {
        $result =  MovieService::updateMovie($request);
        if($result) return response()->json(['Message'=>'Updated successfully'], 200);
    }
}

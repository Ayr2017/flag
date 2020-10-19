<?php
namespace App\Services;
use App\Models\Movie;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MovieService {

    public static function getMovies($request)
    {

        $request->validate([
            'orderBy' => 'nullable|in:id,name',
            'sortDir' => 'nullable|in:asc,desc',
            'amount' => 'nullable|integer',
        ]);

        $orderBy = $request->orderBy ?? 'id';
        $sortDir = $request->sortDir ?? 'desc';
        $amount  = $request->amount ?? 10 ;
        
        $movies = Movie::with('genres:genres.id,genres.name')->orderBy($orderBy, $sortDir)->paginate($amount);
        return $movies;
    }
    public static function getMovieById($id)
    {
        $movie = Movie::with('genres:genres.id,genres.name')->find( $id);
        return $movie;
    }

    public static function getMoviesByGenre($id)
    {
        $movie = Movie::whereHas('genres', function($genre) use ($id) {
            $genre->where('genres.id', $id);
        })->with('genres:genres.id,genres.name')->get();
        return $movie;
    }

    public static function storeMovie($request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'required',
            'released_at' => 'required|date',
            'genres' =>'required',
            'img' => 'required|image'
        ]);
        $path = MovieStorage::storeMovieImg($request->file('img'));
        $imgURL = static::prepareImgPublicURL($path);
        $movieResult = Movie::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'released_at'=>$request->released_at,
            'img'=>$path,
            'imgURL'=>$imgURL,
        ])->genres()->attach(json_decode($request->genres));
        return $movieResult;
    }

    public static function destroyMovie($id)
    {

        $movie = Movie::find($id);
        $movieImgPath = $movie->img;
        $resultDelete = MovieStorage::deleteMovieImg($movieImgPath);
        if(! $resultDelete) return response('Error', 202)->header('Content-Type', 'text/plain');
        $result = $movie->delete();
        return $result;
    }

    public static function updateMovie($request)
    {
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|max:100',
            'description' => 'required',
            'released_at' => 'required|date',
            'genres' =>'required',
        ]);
    
            $movie = Movie::find($request->id);
            if($request->file('img')){
                $movieImgPath = $movie->img;
                $resultDelete = MovieStorage::deleteMovieImg($movieImgPath);
                $path = MovieStorage::storeMovieImg($request->file('img'));
                $imgURL = static::prepareImgPublicURL($path);  
                $movie->img=$path;
                $movie->imgURL=$imgURL;
            }
            $movie->name = $request->name;
            $movie->description=$request->description;
            $movie->released_at=$request->released_at;

            DB::transaction(function () use ($movie, $request) {
                $movie->save();
                $movie->genres()->sync(json_decode($request->genres));
            }, 2);
    }

    
    public static function prepareImgPublicURL($filePath)
    {
        $imgURL = Str::replaceFirst('public','storage', $filePath);
        $host = request()->getHttpHost();
        return 'http://'.$host.'/'.$imgURL;
    }

    
}

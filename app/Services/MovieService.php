<?php
namespace App\Services;
use App\Models\Movie;
use App\Models\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MovieService {
    const DEFAULT_ORDER_BY = 'id';
    const DEFAULT_SORT_DIR = 'desc';
    const DEFAULT_AMOUNT = '10';
    
    /**
     * getMovies
     *
     * @param  Requesy $request
     * @return object
     */
    public static function getMovies(Request $request) :object
    {

        $request->validate([
            'orderBy' => 'nullable|in:id,name',
            'sortDir' => 'nullable|in:asc,desc',
            'amount' => 'nullable|integer',
        ]);

        $orderBy = $request->orderBy ?? self::DEFAULT_ORDER_BY;
        $sortDir = $request->sortDir ?? self::DEFAULT_SORT_DIR;
        $amount  = $request->amount ?? self::DEFAULT_AMOUNT;
        
        $movies = Movie::with(['genres:genres.id,genres.name','files'])->orderBy($orderBy, $sortDir)->paginate($amount);
        return $movies;
    } 
      
    /**
     * getMovieById
     *
     * @param  int $id
     * @return object
     */
    public static function getMovieById(int $id):object
    {
        $movie = Movie::with(['genres:genres.id,genres.name','files'])->find($id);
        return $movie;
    }
    
    /**
     * getMoviesByGenre
     *
     * @param  int $id
     * @return object
     */
    public static function getMoviesByGenre(int $id):object
    {
        $movies = Movie::whereHas('genres', function($genre) use ($id) {
            $genre->where('genres.id', $id);
        })->with(['genres:genres.id,genres.name','files'])->get();
        return $movies;
    }
    
    /**
     * storeMovie
     *
     * @param  int $request
     */
    public static function storeMovie(Request $request)
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

        $movie = new Movie();
        $movie->name = $request->name;
        $movie->description = $request->description;
        $movie->released_at = $request->released_at;
        $movie->save();
        $movie_id = $movie->id;

        $fileServiseResult = FileService::store(new File(),$movie_id, $path, $imgURL);
        $movieResult = $movie->genres()->attach(json_decode($request->genres));

        if($fileServiseResult && $movieResult) return true;
        else return false;
    }
    
    /**
     * destroyMovie
     *
     * @param  int $id
     * @return bool
     */
    public static function destroyMovie(int $id):bool
    {

        $movie = Movie::find($id);
        $file = File::where('movie_id',$id)->first();
        $movieImgPath = $file->name;
        $resultDelete = MovieStorage::deleteMovieImg($movieImgPath);
        if(! $resultDelete) return response()->json(['Error message'=>'Failed to delete file'],202);
        $result = $movie->delete();
        return $result;
    }
    
    /**
     * updateMovie
     *
     * @param  Request $request
     */
    public static function updateMovie(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|max:100',
            'description' => 'required',
            'released_at' => 'required|date',
            'genres' =>'required',
        ]);
    
            $movie = Movie::find($request->id);
            $file = File::where('movie_id', $request->id)->first();
            
            if($request->file('img')){
                $movieImgPath = $file->name;
                $resultDelete = MovieStorage::deleteMovieImg($movieImgPath);
                $path = MovieStorage::storeMovieImg($request->file('img'));
                $imgURL = static::prepareImgPublicURL($path); 
                $fileUpdateResult = FileService::update($file, $path, $imgURL);
            }
            $movie->name = $request->name;
            $movie->description=$request->description;
            $movie->released_at=$request->released_at;

            DB::transaction(function () use ($movie, $request) {
                $movie->save();
                $movie->genres()->sync(json_decode($request->genres));
            }, 2);
            return true;
    }

        
    /**
     * prepareImgPublicURL
     *
     * @param  string $filePath
     * @return string
     */
    public static function prepareImgPublicURL(string $filePath):string
    {
        $imgURL = Str::replaceFirst('public','storage', $filePath);
        $host = request()->getHttpHost();
        return 'http://'.$host.'/'.$imgURL;
    }

    
}

<?php

use App\Http\Controllers\API\v1\MovieController;
use App\Http\Controllers\API\v1\GenreController;
use App\Services\MovieService;
use App\Services\MovieStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('movies')->group(function()
{
    Route::get('/',[MovieController::class,'getMovies']);
    Route::get('/{id}',[MovieController::class,'getMovieById'])->where('id','[0-9]+');
    Route::get('/genre/{id}',[MovieController::class,'getMoviesByGenre'])->where('id','[0-9]+');
    Route::post('/',[MovieController::class,'store']);
    Route::delete('/{id}',[MovieController::class,'destroy'])->where('id','[0-9]+');
    Route::patch('/',[MovieController::class,'update']);
});

Route::prefix('genres')->group(function()
{
    Route::get('/',[GenreController::class,'getGenres']);
});

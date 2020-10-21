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
    Route::get('/',[MovieController::class,'index']);
    Route::get('/{movie}',[MovieController::class,'show'])->where('movie','[0-9]+');
    Route::get('/genre/{genre}',[MovieController::class,'getMoviesByGenre'])->where('genre','[0-9]+');
    Route::post('/',[MovieController::class,'store']);
    Route::delete('/{movie}',[MovieController::class,'destroy'])->where('movie','[0-9]+');
    Route::patch('/',[MovieController::class,'update']);
});

Route::prefix('genres')->group(function()
{
    Route::get('/',[GenreController::class,'getGenres']);
});

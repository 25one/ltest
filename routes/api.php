<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\Auth\Api\LoginController;
use App\Http\Controllers\Auth\Api\LogoutController;
use App\Http\Controllers\Auth\Api\RegisterController;

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

Route::post('login', LoginController::class);
Route::post('register', RegisterController::class);

Route::middleware('auth:api')->group(function () {
    Route::name('episodes')->resource('/episodes', EpisodeController::class);
    Route::name('characters')->get('/characters', [CharacterController::class, 'index']);
    Route::name('characters_random')->get('/characters/random', [CharacterController::class, 'random']);
    Route::name('quotes')->get('/quotes', [QuoteController::class, 'index']);
    Route::name('quotes_random')->get('/quotes/random', [QuoteController::class, 'random']);
    Route::name('stats')->get('/stats', [StatsController::class, 'stats']);
    Route::name('my-stats')->get('/my-stats', [StatsController::class, 'statsMy']);
});

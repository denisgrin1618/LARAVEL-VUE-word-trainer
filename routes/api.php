<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\TranslationController;
use App\Http\Controllers\API\WordController;

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

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

Route::group(['prefix' => 'v1', 'as' => 'api.',  'middleware' => ['auth:sanctum']], function () {
    
    Route::apiResources([
        'words' => WordController::class,
        'translations' => TranslationController::class
    ]);
});

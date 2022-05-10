<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
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
Route::get('test', function () {
    return 'Hello GET2';
});

Route::post('test', function () {
    return 'Hello POST';
});
     
Route::middleware('auth:sanctum')->group( function () {

    Route::apiResources([
        'words' => WordController::class,
    ]);

});

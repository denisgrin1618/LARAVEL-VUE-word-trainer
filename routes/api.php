<?php

use App\Http\Controllers\API\LanguageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\TranslationController;
use App\Http\Controllers\API\WordController;
use App\Models\Language;

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

Route::middleware('auth:sanctum')
    ->prefix('v1')
    ->name('api.')
    ->group( function () {
    
    Route::apiResources([
        'words' => WordController::class,
        'translations' => TranslationController::class,
        'languages' => LanguageController::class
    ]);
});

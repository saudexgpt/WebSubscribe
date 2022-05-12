<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\WebsitesController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'websites'], function () {
    Route::get('/', [WebsitesController::class, 'index']);

    Route::post('/new-subscription', [WebsitesController::class, 'newSubscription']);
});

Route::group(['prefix' => 'posts'], function () {
    Route::post('/store', [PostsController::class, 'store']);
    Route::put('/publish/{post}', [PostsController::class, 'publish']);
});

<?php

use Illuminate\Http\Request;

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

Route::middleware(['auth:api','cors', 'json.response'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['cors', 'json.response']], function () {

    Route::apiResource('/books', BookController::class);
    Route::apiResource('/authors', AuthorController::class);
    Route::apiResource('/categories', CategoryController::class);

});

Route::post('/login','AuthController@login');
Route::post('/register','AuthController@register');
Route::middleware('auth:api')->post('/logout','AuthController@logout');

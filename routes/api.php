<?php

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

Route::get('/quote/{id}', function($id) {
    $quote = App\Models\Quote::query()->findOrFail($id);
    return $quote;
});

$router->group(['prefix' => 'v1/albums'], function ($app) {
// Route::prefix('v1/albums')->group(function() {
    // Returns all the books
    Route::get('/','AlbumController@index');
    // Returns the book with the chosen $id
    Route::get('/{id}','AlbumController@getAlbum');
    // Creates a new book
    Route::post('/','AlbumController@createAlbum');
    // Update the book with the chosen $id
    Route::put('/{id}','AlbumController@updateAlbum');
    // Delete the book with the chosen $id
    Route::delete('/{id}','AlbumController@deleteAlbum');
});

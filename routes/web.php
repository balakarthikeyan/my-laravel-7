<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('admin')->group(function() {
    Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/', 'Auth\AdminController@index')->name('admin.dashboard');
}) ;

Route::resource('products','ProductController');
Route::post('save-products', 'ProductController@ajax')->name('ajax.products');

Route::get('/pages', function () {
    return view('pages.index');
});
Route::get('/test', 'TestController@index')->middleware('testing');

Route::get('chart', 'AjaxController@charts');
Route::get('ajax', 'AjaxController@ajaxPage');
Route::post('ajax', 'AjaxController@ajaxPost')->name('ajax.post');

Route::get('image','ImageController@create')->name('image.create');
Route::post('image','ImageController@store')->name('image.store');
Route::post('ajax-image','ImageController@ajax')->name('image.ajax.store');

Route::get('categories','CategoryController@index');
Route::post('categories/{id}','CategoryController@getCategory')->name('subcategories');

Route::get('/encode', function (\Illuminate\Http\Request $request) {
    return response()->json([
        'result' => base64_encode($request->input('value')),
    ]);
});

Route::get('/decode', function (\Illuminate\Http\Request $request) {
    return response()->json([
        'result' => base64_decode($request->input('value')),
    ]);
});

Route::get('/quote', function() {
    // Picks a different quote every day (for a maximum of 366 quotes)
    // - $count: the total number of available quotes
    // - $day: the current day of the year (from 0 to 365)
    // - $page: the page to look for to retrieve the correct record

    // $count 	= Quote::query()->get()->count();
    // $day 	= (int) date('z');
    // $page 	= $day % $count + 1;
    // $quotes = Quote::query()->get()->forPage($page, 1)->all();
	$quotes = App\Models\Quote::query()->get()->all();

    if (empty($quotes)) {
        throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
    }

    return view('pages.quote', ['quote' => $quotes[0]]);
});
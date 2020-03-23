<?php

use App\Models\Restaurant;
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

Route::get('/', 'RestaurantController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/restaurant', function () {
        $restaurants = Restaurant::paginate(15);
        return view('restaurant.index', compact('restaurants'));
    })->name('admin');
    Route::post('/restaurant/create', 'RestaurantController@store')->name('restaurant.create');
});
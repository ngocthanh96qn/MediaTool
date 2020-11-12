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

Route::get('/admin', function () {
    return view('pages.config_admin');
});

Route::get('/', function () {
    return view('pages.home',['value'=>'']);
})->name('pagehome');
Route::post('/render', 'InstantArticles@test')->name('render');
/////////////////
Route::get('/fix', function () {
    return view('pages.fixDraft');
})->name('fixDraft');
Route::post('/fix', 'InstantArticles@fixDraft')->name('postFix');
//////////
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
//////////////
Route::get('/test', 'InstantArticles@index');


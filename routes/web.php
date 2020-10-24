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
//route admin
Route::get('admintool','ConfigToolController@index' )->name('adminHome');  //về trang admin
Route::post('admin/token','ConfigToolController@createToken')->name('adminToken'); //tao token
Route::post('admin/web','ConfigToolController@createWeb')->name('adminWeb');//tạo cài đặt web

//Các route chính//

Route::get('/', function () {
    return view('pages.home');
})->name('pagehome');
Route::post('/post/article', 'InstantArticles@postArticle')->name('postArticle'); //chức năng đăng bài
///////////
Route::get('/fix', function () {
    return view('pages.fixDraft');
})->name('fixDraft'); 
Route::post('/fix', 'InstantArticles@fixDraft')->name('postFix');//fix lỗi draft
//////////



Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
//////////////


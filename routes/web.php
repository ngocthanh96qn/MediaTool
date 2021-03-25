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
Route::get('admin','ConfigToolController@index' )->name('adminHome');  //về trang admin
Route::post('admin/token','ConfigToolController@createToken')->name('adminToken'); //tao token
Route::post('admin/web','ConfigToolController@createWeb')->name('adminWeb');//tạo cài đặt web
Route::post('admin/web/delete','ConfigToolController@deleteConfigWeb')->name('deleteConfigWeb');//delete web
Route::post('admin/web/edit','ConfigToolController@editConfigWeb')->name('editConfigWeb');//tạo cài đặt web
Route::post('admin/token/delete','ConfigToolController@deleteToken')->name('deleteToken');//xóa token 
Route::post('admin/token/edit','ConfigToolController@editToken')->name('editToken');//sửa token 

//Các route chính//

Route::get('/','Main@home')->name('pagehome');
Route::post('/post/article', 'InstantArticles@postArticle')->name('postArticle'); //chức năng đăng bài
Route::get('/update/ia/{url}','Main@updateIa')->name('updateIa');
Route::get('/update/updateArticle/{url}','Main@updateArticle')->name('updateArticle');
///////////
Route::get('/fix', 'Main@homefix')->name('fixDraft'); 
Route::post('/fix', 'InstantArticles@fixDraft')->name('postFix');//fix lỗi draft
//////////

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
//////////////


<?php

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
    if(Auth::check())
        return redirect('/index');
    else
        return redirect('/login');
});

Auth::routes();
Route::post('/update', 'MyProfileController@create')->name('update');
Route::get('/children','ChildrenController@listChildren');
Route::get('/index', 'HomeController@index')->name('home');
Route::get('/add-child', 'ChildrenController@addChild')->name('add-child');
Route::get('/delete-child', 'ChildrenController@deleteChild')->name('delete-child');
Route::get('/monitor-children', 'ChildrenController@monitorChildren')->name('monitor-children');
Route::get('/children-information', 'ChildrenController@childrenInformation')->name('children-information');
Route::get('/update', 'MyProfileController@updateProfile')->name('update');
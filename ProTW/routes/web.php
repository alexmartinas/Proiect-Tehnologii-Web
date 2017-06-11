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

//Device routes
Route::post('/device/location', 'DeviceController@checkDeviceId2');
Route::post('/device/id', 'DeviceController@checkDeviceId');
Route::post('/device/notification', 'DeviceController@notification');

//PointsOfInterest routes
Route::get('/points-of-interest/getPoints', 'PointsOfInterestController@childPointsOfInterest');
Route::get('/points-of-interest/getGeofences', 'PointsOfInterestController@childGeofences');
Route::post('/points-of-interest/addPoints', 'PointsOfInterestController@addPoints');
Route::post('/points-of-interest/deletePoint', 'PointsOfInterestController@deletePoint');
Route::post('/points-of-interest/setGeofences', 'PointsOfInterestController@setGeofences');

Route::get('/monitor-children/childInfo', 'ChildrenController@childInfo');
Route::post('/add-child', 'ChildrenController@addNewChild')->name('add-child');
Route::post('/add-existing-child', 'ChildrenController@addExistingChild')->name('add-existing-child');
Route::get('/children','ChildrenController@listChildren');
Route::get('/add-child', 'ChildrenController@addChild')->name('add-child');
Route::get('/add-existing-child','ChildrenController@addEChild')->name('add-existing-child');
Route::get('/delete-child', 'ChildrenController@deleteChild')->name('delete-child');
Route::get('/monitor-children', 'ChildrenController@monitorChildren')->name('monitor-children');
Route::get('/children-information', 'ChildrenController@childrenInformation')->name('children-information');
Route::get('/child/{id}', 'ChildrenController@child');

Route::post('/update', 'MyProfileController@update')->name('update');
Route::get('/update', 'MyProfileController@updateProfile')->name('update');

Route::get('/index', 'HomeController@index')->name('home');

Route::get('/listnotifications', 'NotificationsController@listNotifications');
Route::get('/notifications', 'NotificationsController@index')->name('notifications');
Route::get('/saveRecord', 'NotificationsController@saveRecord')->name('saveRecord');

Route::get('contact',
    ['as' => 'contact', 'uses' => 'ContactController@create']);
Route::post('contact',
    ['as' => 'contact_store', 'uses' => 'ContactController@store']);





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

Route::get('/', 'HomeController@welcome');
Route::get('/useful-resources/{fileName}', 'HomeController@downloadUsefulResource');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/visits', 'SchoolVisitRequestController');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', 'UserController@profile');
    Route::post('/profile/store', 'UserController@profileStore');

    Route::get('/users', 'UserController@index');
    Route::resource('/schools', 'SchoolController');
    Route::post('/schools/{id}/approve', 'SchoolController@approve');
    Route::resource('/cities', 'CityController');
    
    Route::post('/visits/approve/{schoolVisitRequest}', 'SchoolVisitRequestController@approve');
    Route::post('/visits/assign/{schoolVisitRequest}', 'SchoolVisitRequestController@assign');
    Route::post('/visits/approve-all', 'SchoolVisitRequestController@approveAll');
    Route::post('/visits/cancel/{schoolVisitRequest}', 'SchoolVisitRequestController@cancelVisit');
    Route::get('/my-visits', 'SchoolVisitRequestController@mySchoolVisits');

    Route::get('/teacher-poll/{schoolVisit}', 'TeacherPollController@create');
    Route::post('/teacher-poll-submit', 'TeacherPollController@submit');
    Route::get('/teacher-poll-show/{teacherPoll}', 'TeacherPollController@show');
    Route::get('/rolemodel-poll/{schoolVisit}', 'RoleModelPollController@create');
    Route::post('/rolemodel-poll-submit', 'RoleModelPollController@submit');
    Route::get('/rolemodel-poll-show/{roleModelPoll}', 'RoleModelPollController@show');
});
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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('/members', 'MembersController')->middleware('auth');
Route::resource('/roll', 'RollController')->middleware('auth');
Route::resource('/activekids', 'ActiveKidsController')->middleware('auth');
Route::resource('/accounting', 'SquadronAccountingController')->middleware('auth');
Route::resource('/settings', 'SettingsController')->middleware('auth');
Route::resource('/form19', 'Form19Controller')->middleware('auth');
Route::resource('/otheritems', 'OtheritemsController')->middleware('auth');

Route::get('/activekids/voucher/{id}', 'ActiveKidsController@voucher')->middleware('auth');
Route::get('/roll/paid/{id}', 'RollController@paid')->middleware('auth');
Route::get('/roll/voucher/{id}', 'RollController@voucher')->middleware('auth');
Route::get('/roll/notpaid/{id}', 'RollController@notpaid')->middleware('auth');
Route::get('/activekids/complete/{id}', 'ActiveKidsController@complete')->middleware('auth');
Route::get('/members/updateroll/{id}', 'RollController@updateRoll')->middleware('auth');
Route::get('/members/delete/{id}', 'MembersController@inactive')->middleware('auth');
Route::get('/outstanding', 'SquadronAccountingController@outstanding')->middleware('auth');
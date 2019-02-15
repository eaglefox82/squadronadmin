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

Route::get('/activekids/voucher/{id}', 'ActiveKidsController@voucher')->middleware('auth');

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
Route::get('/settings', 'SettingsController@index')->middleware('auth');
Route::get('/roll', 'RollController@index')->middleware('auth');
Route::get('/members', 'MembersController@index')->middleware('auth');
Route::get('/activekids', 'ActiveKidsController@index')->middleware('auth');
Route::get('/accounting', 'SquadronAccountingController@index')->middleware('auth');

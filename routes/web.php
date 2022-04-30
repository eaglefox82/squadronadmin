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

use App\Http\Controllers\PastrollController;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('/members', 'MembersController')->middleware('auth');
Route::resource('/roll', 'RollController')->middleware('auth');
Route::resource('/activekids', 'ActiveKidsController')->middleware('auth');
Route::resource('/accounting', 'SquadronAccountingController')->middleware('auth');
Route::resource('/settings', 'SettingsController')->middleware('auth');
Route::resource('/form19', 'Form19Controller')->middleware('auth');
Route::resource('/otheritems', 'OtheritemsController')->middleware('auth');
Route::resource('/stocklist', 'StockController')->middleware('auth');
Route::resource('/users', 'UsersController')->middleware('auth');
Route::resource('/accounts', 'AccountController')->middleware('auth');
Route::resource('/points', 'PointsController')->middleware('auth');
Route::resource('/events', 'EventController')->middleware('auth');
Route::resource('/user', 'UsersController')->middleware('auth');


Route::get('/activekids/voucher/{id}', 'ActiveKidsController@voucher')->middleware('auth');
Route::get('/roll/notpresent/{id}','RollController@notPresent')->middleware('auth');
Route::get('/roll/update/{id}/{status}', 'RollController@rollstatus')->middleware('auth');
Route::get('/vouchers/complete/{id}', 'ActiveKidsController@complete')->middleware('auth');
Route::get('/vouchers/submit/{id}', 'ActiveKidsController@submit')->middleware('auth');
Route::get('/members/updateroll/cash/{id}', 'RollController@updateRollCash')->middleware('auth');
Route::get('/members/updateroll/account/{id}', 'RollController@updateRollAccount')->middleware('auth');
Route::get('/members/delete/{id}', 'MembersController@inactive')->middleware('auth');
Route::get('/outstanding', 'SquadronAccountingController@outstanding')->middleware('auth');
Route::get('requested', 'SquadronAccountingController@requested')->middleware('auth');
Route::get('/parade', 'RollController@parade')->middleware('auth');
Route::get('/birthday', 'MembersController@birthday')->middleware('auth');
Route::get('/eventroll/attending/{id}', 'EventController@eventattending')->middleware('auth');
Route::get('/eventroll/attended/{id}/{others}', 'EventController@eventattended')->middleware('auth');
Route::get('/eventroll/form17/{id}/{others}','EventController@eventform17')->middleware('auth');
Route::get('/eventroll/paid/{id}/{others}', 'EventController@eventpaid')->middleware('auth');
Route::get('/otheritems/{id}/inactive', 'OtheritemsController@inactive')->middleware('auth');
Route::get('/new/members', 'MembersController@newmembers')->middleware('auth');
Route::get('/events/delete/{id}', 'EventController@inactive')->middleware('auth');
Route::get('/annualsubs', 'SquadronAccountingController@annualsubs')->middleware('auth');
Route::get('/pastevents', 'EventController@listPastEvents')->middleware('auth');

Route::post('vouchers/banking/{id}', 'ActiveKidsController@bankingreference')->middleware('auth');
Route::post('/profile/update/avatar', 'UsersController@update_avatar')->middleware('auth');
Route::post('/pastroll/post','PastrollController@getRoll')->middleware('auth');
Route::post('/accounting/payment/', 'SquadronAccountingController@payment')->middleware('auth');
Route::post('/accounting/request/update{id}', 'SquadronAccountingController@update')->middleware('auth');
Route::post('/accounts/voucher/', 'AccountController@item')->middleware('auth');
Route::post('/requested/accountpay', 'SquadronAccountingController@accountpayment')->middleware('auth');
Route::post('/member/points', 'PointsController@addtomember')->middleware('auth');
Route::post('event/show/nonmember', 'EventController@addNonMember')->middleware('auth');




//Reports
Route::get('/report/roll/print/{id}', 'ReportController@printRoll')->middleware('auth');
Route::post('/reports/form19/print', 'Form19Controller@printForm')->middleware('auth');
Route::get('/reports/attendance', 'ReportController@attendance')->middleware('auth');
Route::get('/reports/welcome', 'ReportController@welcome')->middleware('auth');
Route::get('reports/past', 'ReportController@past')->middleware('auth');
Route::get('reports/download/{id}', 'ReportController@downloadpast')->middleware('auth');
Route::get('report/email', 'ReportController@email')->middleware('auth');
Route::get('report/points/print', 'ReportController@print_points')->middleware('auth');


// Ajax requests
Route::get('get/payments/{id}', 'MembersController@getPayments')->middleware('auth')->name('getPayments');
Route::get('get/points', 'PointsController@getPoints')->name('getPoints');
Route::get('get/members', 'MembersController@getMemberlist')->name('getMemberlist');
Route::get('get/roll/current', 'RollController@getCurrentRoll')->name('getCurrentRoll');
Route::get('get/report/attendance', 'ReportController@getAttendance')->name('getAttendance');


//Deployment - use this to force command line calls during deployments
Route::get('/storage-link', function () {
    return Artisan::call('storage:link', ["--force" => true]);
});

Route::get('/deployment', function(){
    return Artisan::call('migrate');
});


//Testing Routes
Route::get('/testing/roll', 'RollController@index_test')->middleware('auth');
Route::get('/testing/attendance', 'ReportController@attendance_test')->middleware('auth');


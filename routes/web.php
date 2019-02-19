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
//
//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/game', 'GameController@index')->name('game.index')->middleware('auth');

// параметры
Route::get('/configs', 'ConfigController@index')->name('configs.index')->middleware('auth');
Route::post('/configs', 'ConfigController@update')->name('configs.update')->middleware('auth');

// заявки на пополнение баланса
Route::get('/put_money', 'PutMoneyController@index')->name('put_money.index')->middleware('auth');
Route::get('/put_money/create', 'PutMoneyController@create')->name('put_money.create')->middleware('auth');
Route::post('/put_money/create', 'PutMoneyController@store')->name('put_money.store')->middleware('auth');

Route::get('/put_money/user_puts', 'PutMoneyController@user_puts')->name('put_money.user_puts')->middleware('auth');
Route::post('/put_money/change_status', 'PutMoneyController@change_status')->name('put_money.change_status')->middleware('auth');

// заявки на снятие средств с баланса
Route::get('/out_money', 'OutMoneyController@index')->name('out_money.index')->middleware('auth');
Route::get('/out_money/create', 'OutMoneyController@create')->name('out_money.create')->middleware('auth');
Route::post('/out_money/create', 'OutMoneyController@store')->name('out_money.store')->middleware('auth');

Route::get('/out_money/user_outs', 'OutMoneyController@user_outs')->name('out_money.user_outs')->middleware('auth');
Route::post('/out_money/change_status', 'OutMoneyController@change_status')->name('out_money.change_status')->middleware('auth');

// способы оплаты
Route::get('/pay_variables/list', 'PayVariableController@index')->name('pay_variables.index')->middleware('auth');
Route::get('/pay_variables/create', 'PayVariableController@create')->name('pay_variables.create')->middleware('auth');
Route::post('/pay_variables/create', 'PayVariableController@store')->name('pay_variables.store')->middleware('auth');
Route::get('/pay_variables/{id}/edit', 'PayVariableController@edit')->name('pay_variables.edit')->middleware('auth');
Route::post('/pay_variables/{id}/update', 'PayVariableController@update')->name('pay_variables.update')->middleware('auth');
Route::delete('/pay_variables/{id}/destroy', 'PayVariableController@destroy')->name('pay_variables.destroy')->middleware('auth');

/**
 * игра
 */
// cron. Создание новой игры
Route::get('/game/check_start', 'GameController@check_start')->name('game.check_start')->middleware('auth');

// вступление в игру игрока
Route::post('/game/join', 'GameController@join_game')->name('game.join')->middleware('auth');
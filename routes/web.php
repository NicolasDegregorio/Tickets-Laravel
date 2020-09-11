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

use App\Role;

Route::get('/dashboard','FrontEndController@index');
Route::get('/dashboard/usuarios','FrontEndController@users');
Route::get('/dashboard/usuarios/tickets', 'FrontEndController@ticketsSituation');

Route::resource('ticket', 'TicketController');
Route::resource('institution', 'InstitutionController');
Route::get('/getTickets/{id}' , 'TicketController@getTickets');
Route::get('/tickets/{id}', 'TicketController@index')->middleware('UserTicket');
Route::post('/add_user_team', 'TicketController@team_ticket')->middleware('UserTicket');;
Route::post('/change_state', 'TicketController@change_state')->middleware('UserTicket');;


Route::get('/institutions' , 'InstitutionController@getInstitutions');

Route::get('/calendar' , 'FrontEndController@calendar');

//Rutas Modulo Usuarios
Route::get('/', 'UserController@login');
Route::post('/authenticate', 'UserController@authenticate');
Route::post('/users/create', 'UserController@register' );
Route::get('/users/logout', 'UserController@logout');
Route::get('/dashboard/usuarios','FrontEndController@users');
Route::get('/users', 'UserController@getUsers');
Route::get('/users/{id}', 'UserController@show');
Route::put('/users/{id}', 'UserController@update');
Route::delete('/users/{id}', 'UserController@destroy');

Route::resource('stock', 'StockController');
Route::get('/stocks', 'StockController@getStocks');

Route::resource('/category', 'CategoryController');
Route::get('/categories', 'CategoryController@getCategory');

Route::resource('/office', 'OfficeController');
Route::get('/offices', 'OfficeController@getOffices');

Route::resource('message', 'MessageController');

Route::get('/report', 'ReportController@index');
Route::get('/filter/ticket_situation', 'ReportController@ticket_situation');
Route::get('/filter/range_date', 'ReportController@filter_range');

Route::get('/reports', 'ReportController@report');

<?php    

Route::get('/', 'CalendarioController@home');
Route::resource('/server/professor', 'ProfessorController');
Route::resource('/server/calendario', 'CalendarioController');
Route::resource('/server/user', 'UserController');

Route::get('/calendars', 'CalendarioController@index');
Route::post('/calendars', 'CalendarioController@store');
Route::get('/calendars/{id}', 'CalendarioController@show');
Route::put('/calendars/{id}', 'CalendarioController@update');
Route::delete('/calendars/{id}', 'CalendarioController@destroy');

Route::dispatch();
?>

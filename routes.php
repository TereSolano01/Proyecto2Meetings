<?php    

Route::get('/', 'CalendarioController@index');
Route::resource('/server/professor', 'ProfessorController');
Route::resource('/server/calendario', 'CalendarioController');
Route::resource('/server/user', 'UserController');

Route::get('/professors', 'ProfessorController@index');
Route::post('/professors', 'ProfessorController@store');
Route::get('/professors/{id}', 'ProfessorController@show');
Route::put('/professors/{id}', 'ProfessorController@update');
Route::delete('/professors/{id}', 'ProfessorController@destroy');

// Rutas para el recurso de calendario
Route::get('/calendars', 'CalendarioController@index');
Route::post('/calendars', 'CalendarioController@store');
Route::get('/calendars/{id}', 'CalendarioController@show');
Route::put('/calendars/{id}', 'CalendarioController@update');
Route::delete('/calendars/{id}', 'CalendarioController@destroy');

Route::dispatch();
?>

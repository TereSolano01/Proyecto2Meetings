<?php    

Route::resource('/server/professor', 'ProfessorController');
Route::resource('/server/calendario', 'CalendarioController');
Route::resource('/server/user', 'UserController');
Route::dispatch();
?>

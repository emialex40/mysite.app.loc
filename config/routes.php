<?php

use App\Router\Route;
use App\Controllers\HomeController;
use App\Controllers\MoviesController;

return [
	Route::get('/home', [HomeController::class, 'index']),
	Route::get('/movies', [MoviesController::class, 'index']),
	Route::get('/test', function() {
		echo 'Test';
	}),
];

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FAQController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Auth
Route::get('/check/username/{username}', [RegisterController::class, 'checkIfUsernameExists']);
Route::get('/check/email/{email}', [RegisterController::class, 'checkIfEmailExists']);

//FAQ
Route::get('/faq', [FAQController::class, 'index']);
Route::get('/faq/show', [FAQController::class, 'show']);
<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskRequestController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
})->name('home');

Route::resource('task', TaskController::class);

Route::get('taskrequest/{taskrequest}/take', [TaskRequestController::class, 'take'])->name('taskrequest.take');
Route::resource('taskrequest', TaskRequestController::class);

Route::get('calendar', function () {
    return view('calendar');
})->name('calendar');

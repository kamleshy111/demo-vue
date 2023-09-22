<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
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
    return view('home');
});

Route::get('/employees', [EmployeeController::class, 'index'])->name('index');
Route::get('/employee-list', [EmployeeController::class, 'list'])->name('list');
Route::post('/employee-add', [EmployeeController::class, 'add'])->name('add');
Route::post('/get-employee-by-id', [EmployeeController::class, 'show']);
Route::post('/update-employee-by-id', [EmployeeController::class, 'update']);
Route::post('/delete-employee-by-id', [EmployeeController::class, 'destroy']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

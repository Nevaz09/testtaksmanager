<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FrontendController;
use App\Http\Controllers\Admin\TaksController;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::middleware(['auth', 'isAdmin'])->group(function(){
    Route::group(['isAdmin'=>'dashboard'], function(){
        Route::get('taks', [TaksController::class, 'index']);
        Route::get('add-taks', [TaksController::class, 'add'])->name('add-taks');
        Route::post('insert-taks', [TaksController::class, 'insert']);
        Route::get('taksView-taks/{id}',[TaksController::class, 'viewTaks']);
        Route::get('destroy-taks/{id}', [TaksController::class, 'destroy']);
        Route::post('destroyalltaks', [TaksController::class, 'destroyall'])->name('destroyalltaks');
        Route::put('isnsertanswer-taks/{id}', [TaksController::class, 'inserttaks']);
        Route::get('download-answertaks/{id}', [TaksController::class, 'downloadtaks']);
    });    
    Route::group(['isAdmin'=>'dashboard'], function(){
        Route::get('dashboard', [FrontendController::class, 'index']);
        Route::get('users', [DashboardController::class, 'users']);
        Route::get('view-users/{id}', [DashboardController::class, 'viewUsers']);
        Route::get('edit-users/{id}', [DashboardController::class, 'editUsers']);
        Route::put('update-users/{id}', [DashboardController::class, 'updateUsers']);
    });
    
    

    
});
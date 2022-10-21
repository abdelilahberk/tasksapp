<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TaskArchiveController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Auth;
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
    return view('admin.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/login', [LoginController::class, 'showLoginForm']);

// freewordmedia
Route::group(["middleware"=>"auth"],function(){

    // taksk
    Route::resource("/tasks",TaskController::class);
    Route::get("taskss/statistics",[TaskController::class,"statistics"])->name("taskss.statistics");
    // tasks archive
    Route::resource("tasksarchive",TaskArchiveController::class);


    // tasks tickets tickets
    Route::resource("tasks.tickets",TicketController::class);
    // Route::resource("/comments",CommentController::class);
    // tickets comments
    Route::resource("/tasks.tickets.comments",CommentController::class);
});

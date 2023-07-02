<?php

use App\Http\Controllers\profController\professorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'auth', 'professor'], function () {

    Route::prefix('professor')->group(function () {
        Route::controller(professorController::class)->group(function () {
            Route::get('/dashboard', 'coursesPage');
            Route::get('/courses', 'coursesPage');
            Route::get('/archive', 'archivedPage');
            Route::get('/students', 'studentsPage');
            Route::get('/departments', 'department');
            Route::post('/courses/student/mark', 'addMark');
            Route::post('/courses/student/edit-mark', 'editMark');
        });
    });

});

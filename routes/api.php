<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('courses')->group(function () { 
    Route::post('/', [CourseController::class, 'store']); // create
    Route::get('/', [CourseController::class, 'index']); // list with filters
    Route::get('/{id}', [CourseController::class, 'show']); // show 
    Route::put('/{id}', [CourseController::class, 'update']); // update 
    Route::delete('/{id}', [CourseController::class, 'destroy']); // delete 
    
});

Route::prefix('students')->group(function () { 
    Route::post('/', [StudentController::class, 'store']); // create 
    Route::put('/{id}', [StudentController::class, 'update']); // update 
    Route::get('/{id}', [StudentController::class, 'show']); // show 
});

Route::middleware('auth:sanctum')->prefix('comments')->group(function () { 
    Route::post('/', [CommentController::class, 'store']); // create 
    Route::get('/', [CommentController::class, 'index']); // list 
    Route::put('/{id}', [CommentController::class, 'update']); // update 
    Route::delete('/{id}', [CommentController::class, 'destroy']); // delete 
});

Route::middleware('auth:sanctum')->prefix('registrations')->group(function () {
     Route::post('/', [RegistrationController::class, 'store']); // create 
     Route::get('/', [RegistrationController::class, 'index']); // list 
     Route::get('/{id}', [RegistrationController::class, 'show']); // show 
     Route::put('/{id}', [RegistrationController::class, 'update']); // update 
});


<?php

use App\Http\Controllers\AuthController;
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

// Route::controller(RegisterController::class)->group(function(){
//     Route::post('register', 'register');
//     Route::post('login', 'login');
// });



//auth routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {

    //get authenticated user details
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //comment routes
    Route::prefix('comments')->group(function () { 
        Route::post('/', [CommentController::class, 'store']); // create 
        Route::get('/', [CommentController::class, 'index']); // list 
        Route::put('/{id}', [CommentController::class, 'update']); // update 
        Route::delete('/{id}', [CommentController::class, 'destroy']); // delete 
    });
    
    //registration routes
    Route::prefix('registrations')->group(function () {
         Route::post('/', [RegistrationController::class, 'store']); // create 
         Route::get('/', [RegistrationController::class, 'index']); // list 
         Route::get('/{id}', [RegistrationController::class, 'show']); // show 
         Route::put('/{id}', [RegistrationController::class, 'update']); // update 
    });
});


//course routes
Route::prefix('courses')->group(function () { 
    Route::post('/', [CourseController::class, 'store']); // create
    Route::get('/', [CourseController::class, 'index']); // list with filters
    Route::get('/{id}', [CourseController::class, 'show']); // show 
    Route::put('/{id}', [CourseController::class, 'update'])->middleware('auth:sanctum'); // update 
    Route::delete('/{id}', [CourseController::class, 'destroy'])->middleware('auth:sanctum'); // delete 
});

//student routes
Route::prefix('students')->group(function () { 
    Route::post('/', [StudentController::class, 'store']); // create 
    Route::put('/{id}', [StudentController::class, 'update']); // update 
    Route::get('/{id}', [StudentController::class, 'show']); // show
    Route::delete('/{id}', [StudentController::class, 'destroy'])->middleware('auth:sanctum'); // delete 

});




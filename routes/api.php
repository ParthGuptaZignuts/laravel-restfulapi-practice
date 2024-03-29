<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;

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

// Public routes
// Route::get('/students',[StudentController::class,'index']);
// Route::get('/students/{id}',[StudentController::class,'show']);
// Route::post('/students',[StudentController::class,'store']);
// Route::put('/students/{id}',[StudentController::class,'update']);
// Route::delete('/students/{id}',[StudentController::class,'destroy']);
// Route::get('/students/search/{city}',[StudentController::class,'search']);



Route::post('/register',[UserController::class, 'register']);
Route::post('/login',[UserController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->get('/students',[StudentController::class,'index']);

// group routes 
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/students/{id}',[StudentController::class,'show']);
    Route::post('/students',[StudentController::class,'store']);
    Route::put('/students/{id}',[StudentController::class,'update']);
    Route::delete('/students/{id}',[StudentController::class,'destroy']);
    Route::get('/students/search/{city}',[StudentController::class,'search']);
    Route::post('/logout',[UserController::class, 'logout']);
});


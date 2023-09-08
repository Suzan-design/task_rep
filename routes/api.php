<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;

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


Route::post('register',[App\Http\Controllers\UserController::class, 'register']);

Route::post('login',[App\Http\Controllers\UserController::class, 'login']);

Route::post('addPage',[App\Http\Controllers\PageController::class, 'addPage']);

Route::post('addProduct',[App\Http\Controllers\ProductController::class, 'addProduct']);

Route::post('discount',[App\Http\Controllers\UserController::class, 'discount']);

Route::post('addMember',[App\Http\Controllers\UserController::class, 'addMember']);

Route::post('blockUser',[App\Http\Controllers\UserController::class, 'blockUser']);

Route::post('getInformation',[App\Http\Controllers\UserController::class, 'getInformation']);

Route::post('addFriend',[App\Http\Controllers\UserController::class, 'addFriend']);

Route::post('sendInvite',[App\Http\Controllers\UserController::class, 'sendInvite']);

Route::post('sell',[App\Http\Controllers\UserController::class, 'sell']);

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController as AuthController;
use App\Http\Controllers\UserController as UserController;
use App\Http\Controllers\ContactController as ContactController;
use App\Http\Controllers\GroupChatController as GroupChatController;
use App\Http\Controllers\MessagesController AS MessagesController;

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

Route::middleware('auth:sanctum')->group( function () {
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::put('/user/{id}', [UserController::class, 'update']);
    Route::delete('/user/{id}', [UserController::class, 'delete']);
    // add serach route in user

    Route::get('/contact', [ContactController::class, 'index']);
    Route::post('/contact/create', [ContactController::class, 'store']);
    Route::put('/contact/{id}', [ContactController::class, 'update']);
    Route::delete('/contact/{id}', [ContactController::class, 'delete']);
    Route::get('/contact/search', [ContactController::class, 'search']);
    Route::get('/contact/request', [ContactController::class, 'contactRequest']);
    Route::put('/contact/confirm/{id}', [ContactController::class, 'contactConfirm']);
    Route::get('/contact/{id}', [ContactController::class, 'show']);

    Route::get('/group', [GroupChatController::class, 'index']);
    Route::post('/group/create', [GroupChatController::class, 'store']);
    Route::put('/group/{id}', [GroupChatController::class, 'update']);
    Route::delete('/group/{id}', [GroupChatController::class, 'delete']);
    Route::post('/group/member/{id}', [GroupChatController::class, 'addMember']);
    Route::delete('/group/member/{id}', [GroupChatController::class, 'removeMember']);
    Route::get('/group/{id}', [GroupChatController::class, 'show']);

    Route::get('/messages', [MessagesController::class, 'index']);
    Route::post('/messages/create', [MessagesController::class, 'store']);
    Route::put('/messages/{id}', [MessagesController::class, 'update']);
    Route::delete('/messages/{id}', [MessagesController::class, 'delete']);
    Route::get('/messages/{id}', [MessagesController::class, 'show']);
    Route::get('/auth/login', [AuthController::class, 'logout']);
    // add serach route in message
});

Route::get('/auth', [AuthController::class, 'auth']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/validate/otp', [AuthController::class, 'otpValidate']);
Route::post('/user/create', [UserController::class, 'store']);

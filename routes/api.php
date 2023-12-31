<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TodoController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => 'auth:api'], function(){
    Route::prefix('user')->controller(UserController::class)->group(function () {
        Route::get('detail', 'detail');
        Route::post('change-password', 'changePassword');
        Route::post('update', 'update');
    });

    Route::prefix('todo')->controller(TodoController::class)->group(function () {
        Route::get('list', 'list');
        Route::get('detail', 'detail');
        Route::post('store', 'store');
        Route::put('update', 'update');
        Route::delete('destroy', 'destroy');
    });
});

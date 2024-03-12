<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LibraryController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/v1')->group(function(){
    Route::get('/{library}/books', [LibraryController::class, 'getBooks']);
    Route::post('/user/register', [UserController::class, 'registerUser']);
    Route::post('/transaction/borrow', [TransactionController::class, 'borrowBook']);
    Route::post('/transaction/return', [TransactionController::class, 'returnBook']);
});
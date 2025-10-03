<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\OrderLabController;


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


// Route::post('/login', [AuthController::class, 'login']);


// Route::middleware(['auth:sanctum', 'token.expiry'])->group(function () {
//     Route::get('/me', [AuthController::class, 'me']);
//     Route::post('/logout', [AuthController::class, 'logout']);
//     Route::post('/order-lab', [OrderLabController::class, 'receive']);

// });
Route::get('/kirim-lab/{id}', [OrderLabController::class, 'kirimSIMRS'])->name('simrs.kirim_lab');
// Route::get('/kirim-lab/{id}', function ($id) {
//     return response()->json([
//         'status' => true,
//         'data_id' => $id
//     ]);
// });

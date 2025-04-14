<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TravelRequestController;
use App\Http\Controllers\AuthController;

Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->post('logout', [AuthController::class, 'logout']);

Route::middleware('auth:api')->group(function () {
    Route::get('/requests', [TravelRequestController::class, 'index']);
    Route::post('/requests', [TravelRequestController::class, 'store']);
    Route::get('/requests/{id}', [TravelRequestController::class, 'show']);
    Route::patch('/requests/{id}/status', [TravelRequestController::class, 'updateStatus']);
});

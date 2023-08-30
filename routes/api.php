<?php

use App\Http\Controllers\DelayController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\AgentController;
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

Route::get("orders", [OrderController::class, "index"]);
Route::get("agents", [AgentController::class, "index"]);
Route::get("vendors", [VendorController::class, "index"]);
Route::get("delay/report", [DelayController::class, "report"]);
Route::post("delay/alert", [DelayController::class, "alert"]);
Route::post("delay/assign", [DelayController::class, "assign"]);


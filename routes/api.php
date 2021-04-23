<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedicationController;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/medication', [MedicationController::class, 'index']);
Route::get('/medication/{id}', [MedicationController::class, 'show']);

// Private Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::put('/medication/{id}',    [MedicationController::class, 'update']);
    Route::post('/medication',        [MedicationController::class, 'store']);
    Route::delete('/medication/{id}', [MedicationController::class, 'destroy']);
});

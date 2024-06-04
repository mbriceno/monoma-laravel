<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidateController;
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

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('auth', [AuthController::class, 'login'])->name('auth.login');
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('auth.refresh_token');
    Route::post('me', [AuthController::class, 'me'])->name('auth.me');
});

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('lead', [CandidateController::class, 'store'])->name('candidate.store');
    Route::get('lead/{id}', [CandidateController::class, 'show'])->name('candidate.show');
    Route::get('leads', [CandidateController::class, 'index'])->name('candidate.list');
});

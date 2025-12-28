<?php

use App\Http\Controllers\WeightLogController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth')->group(function () {
Route::get('/register/step2', [WeightLogController::class, 'showRegisterStep2'])
    ->name('register.step2');

Route::post('/register/step2', [WeightLogController::class, 'storeRegisterStep2'])
    ->name('register.step2.store');

Route::middleware('goal')->group(function () {
Route::get('/weight_logs/goal_setting', [WeightLogController::class, 'goalEdit'])
    ->name('weight_logs.goal_setting');

Route::put('/weight_logs/goal_setting', [WeightLogController::class, 'goalUpdate'])
    ->name('weight_logs.goal_update');

Route::get('/weight_logs', [WeightLogController::class, 'index'])
    ->name('weight_logs.index');

Route::get('/weight_logs/search', [WeightLogController::class, 'search'])
    ->name('weight_logs.search');

Route::post('/weight_logs', [WeightLogController::class, 'store'])
    ->name('weight_logs.store');

Route::get('/weight_logs/{weightLog}', [WeightLogController::class, 'edit'])
    ->whereNumber('weightLog')
    ->name('weight_logs.edit');

Route::put('/weight_logs/{weightLog}/update', [WeightLogController::class, 'update'])
    ->name('weight_logs.update');

Route::delete('/weight_logs/{weightLog}/delete', [WeightLogController::class, 'destroy'])
    ->name('weight_logs.delete');

});
});


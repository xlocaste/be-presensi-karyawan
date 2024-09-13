<?php

use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PresensiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/karyawan', [KaryawanController::class, 'index']);
Route::post('/karyawan', [KaryawanController::class, 'store']);
Route::get('/karyawan/{karyawan}', [KaryawanController::class, 'show']);
Route::put('/karyawan/{karyawan}', [KaryawanController::class, 'update']);
Route::delete('/karyawan/{karyawan}', [KaryawanController::class, 'destroy']);

Route::get('/presensi', [PresensiController::class, 'index']);
Route::post('/presensi', [PresensiController::class, 'store']);
Route::get('/presensi/{presensi}', [PresensiController::class, 'show']);
Route::put('/presensi/{presensi}', [PresensiController::class, 'update']);
Route::delete('/presensi/{presensi}', [PresensiController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

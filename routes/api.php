<?php

use App\Http\Controllers\CertificatesReleaseController;
use App\Http\Controllers\CertificatesDownloadController;
use App\Http\Controllers\CertificatesSearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('certificates/release', [CertificatesReleaseController::class, 'execute']);
Route::get('certificates/{term}', [CertificatesSearchController::class, 'execute']);
Route::get('certificates/{code}/download', [CertificatesDownloadController::class, 'execute']);

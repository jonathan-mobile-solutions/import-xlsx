<?php

use App\Http\Controllers\ImportController;
use App\Http\Controllers\PlacaOcorrenciaController;
use App\Models\PlacaOcorrencia;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/import', [PlacaOcorrenciaController::class, 'index']);

Route::post('/import', [PlacaOcorrenciaController::class, 'store'])->name('import');

Route::get('/config', function () {
    return view('config');
});

Route::post('/config', [PlacaOcorrenciaController::class, 'create'])->name('config');

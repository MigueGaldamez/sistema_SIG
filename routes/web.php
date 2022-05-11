<?php

use App\Http\Controllers\TacticosController;
use App\Http\Controllers\EstrategicosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/estrategicos', function () {
    return view('paginas.reportesestrategicos');
});

Route::get('/tacticos', function () {
    return view('paginas.reportestacticos');
});
Route::get('/tacticos-uno', [TacticosController::class, 'mostrarTactico1'])->name('tacticos.uno');
Route::get('/tacticos-dos', [TacticosController::class, 'mostrarTactico2'])->name('tacticos.dos');
Route::get('/tacticos-tres', [TacticosController::class, 'mostrarTactico3'])->name('tacticos.tres');
Route::get('/estrategicos-uno', [EstrategicosController::class, 'mostrarEstrategico1'])->name('estrategicos.uno');
Route::get('/estrategicos-dos', [EstrategicosController::class, 'mostrarEstrategico2'])->name('estrategicos.dos');

Route::get('/filtrar-estrategicos-uno', [EstrategicosController::class, 'filtrarEstrategico1'])->name('filtrar.e.uno');
Route::get('/filtrar-estrategicos-dos', [EstrategicosController::class, 'filtrarEstrategico2'])->name('filtrar.e.dos');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

<?php

use App\Http\Controllers\TacticosController;
use App\Http\Controllers\EstrategicosController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/estrategicos', function () {
    return view('paginas.reportesestrategicos');
})->name('menu.e');

Route::get('/tacticos', function () {
    return view('paginas.reportestacticos');
})->name('menu.t');

Route::get('/tacticos-uno', [TacticosController::class, 'mostrarTactico1'])->name('tacticos.uno');
Route::get('/tacticos-dos', [TacticosController::class, 'mostrarTactico2'])->name('tacticos.dos');
Route::get('/tacticos-tres', [TacticosController::class, 'mostrarTactico3'])->name('tacticos.tres');
Route::get('/estrategicos-uno', [EstrategicosController::class, 'mostrarEstrategico1'])->name('estrategicos.uno');
Route::get('/estrategicos-dos', [EstrategicosController::class, 'mostrarEstrategico2'])->name('estrategicos.dos');

Route::get('/filtrar-estrategicos-uno', [EstrategicosController::class, 'filtrarEstrategico1'])->name('filtrar.e.uno');
Route::get('/filtrar-estrategicos-dos', [EstrategicosController::class, 'filtrarEstrategico2'])->name('filtrar.e.dos');

Route::get('/filtrar-tacticos-uno', [TacticosController::class, 'filtrarTactico1'])->name('filtrar.t.uno');
Route::get('/filtrar-tacticos-dos', [TacticosController::class, 'filtrarTactico2'])->name('filtrar.t.dos');
Route::get('/filtrar-tacticos-tres', [TacticosController::class, 'filtrarTactico3'])->name('filtrar.t.tres');

//PDF
Route::get('/pdf-tacticos-uno', [TacticosController::class, 'pdfTactico1'])->name('pdf.t.uno');
Route::get('/pdf-tacticos-dos', [TacticosController::class, 'pdfTactico2'])->name('pdf.t.dos');
Route::get('/pdf-tacticos-tres', [TacticosController::class, 'pdfTactico3'])->name('pdf.t.tres');

Route::get('/pdf-estrategico-uno', [EstrategicosController::class, 'pdfEstrategico1'])->name('pdf.e.uno');
Route::get('/pdf-estrategico-dos', [EstrategicosController::class, 'pdfEstrategico2'])->name('pdf.e.dos');

Route::get('/admin-bitacora', [AdminController::class, 'adminBitacora'])->name('admin.bitacora');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

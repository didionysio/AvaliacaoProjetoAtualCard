<?php

use App\Http\Controllers\EspecialidadeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\ConsultaController;
use Illuminate\Support\Facades\Auth;


Route::get('/medicos/search', [MedicoController::class, 'search'])->name('medicos.search');
Route::get('/pacientes/{id}/idade', [PacienteController::class, 'idade'])->name('pacientes.idade');

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    }

    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('home');



Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('pacientes', PacienteController::class);
    Route::resource('medicos', MedicoController::class);
    Route::resource('especialidades',EspecialidadeController::class);
    Route::resource('consultas',ConsultaController::class);
});

require __DIR__.'/auth.php';

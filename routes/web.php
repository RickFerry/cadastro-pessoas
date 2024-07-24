<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\EnderecoController;

Route::prefix('pessoas')->group(function () {
    Route::get('/', [PessoaController::class, 'index'])->name('pessoas.index');
    Route::get('/create', [PessoaController::class, 'create'])->name('pessoas.create');
    Route::post('/', [PessoaController::class, 'store'])->name('pessoas.store');
    Route::get('/{id}', [PessoaController::class, 'show'])->name('pessoas.show');
    Route::get('/{id}/edit', [PessoaController::class, 'edit'])->name('pessoas.edit');
    Route::put('/{id}', [PessoaController::class, 'update'])->name('pessoas.update');
    // Define rotas para endereços relacionados a pessoas, utilizando shallow nesting
    Route::resource('/{pessoa}/enderecos', EnderecoController::class)->shallow();
});

// Rota inicial simplificada, sem repetição
Route::get('/', function () {
    return view('welcome');
});

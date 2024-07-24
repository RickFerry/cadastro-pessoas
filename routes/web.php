<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\EnderecoController;

Route::get('/', [PessoaController::class, 'index'])->name('pessoas.index');
Route::get('/pessoas/create', [PessoaController::class, 'create'])->name('pessoas.create');
Route::post('/pessoas', [PessoaController::class, 'store'])->name('pessoas.store');
Route::get('/pessoas/{id}', [PessoaController::class, 'show'])->name('pessoas.show');
Route::get('/pessoas/{id}/edit', [PessoaController::class, 'edit'])->name('pessoas.edit');
Route::put('/pessoas/{id}', [PessoaController::class, 'update'])->name('pessoas.update');

Route::post('/pessoas/{id}/enderecos', [EnderecoController::class, 'store'])->name('enderecos.store');
Route::put('/enderecos/{id}', [EnderecoController::class, 'update'])->name('enderecos.update');

Route::get('/', function () {
    return view('welcome');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TarefaController;


Route::get('/cadastro', [CadastroController::class, 'cadastro'])->name('cadastro');
Route::post('/cadastro', [CadastroController::class, 'store'])->name('cadastro.store');
Route::get('/login', [LoginController::class, 'Login_index'])->name('login');
Route::post('/login', [LoginController::class, 'Login_verification'])->name('login.verification');
Route::get('/logout', [LoginController::class, 'Logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/tarefa/{id}/edit', [TarefaController::class, 'edit'])->name('tarefa.edit');
    Route::put('/tarefa/{id}/edit', [TarefaController::class, 'update'])->name('tarefa.update');
    Route::get('/tarefa', [TarefaController::class, 'tarefa'])->name('tarefa');
    Route::post('/tarefa', [TarefaController::class, 'store'])->name('tarefa.store');
    Route::delete('/tarefa/{tarefa}', [TarefaController::class, 'delete'])->name('tarefa.delete');
});

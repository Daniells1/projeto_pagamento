<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SistemaController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\FuncionarioController;

Route::match(['post', 'get'], '/', [SistemaController::class, 'index'])->name("home");
Route::match(['post', 'get'], '/cargos', [CargoController::class, 'index'])->name("cargo");
Route::match(['post', 'get'], '/projetos', [ProjetoController::class, 'index'])->name("projeto");

Route::get('/funcionario/novo', [FuncionarioController::class, 'novo'])->name("funcionario_novo"); 
Route::get('/funcionario/{id}/editar', [FuncionarioController::class, 'novo'])->name("funcionario_editar");   
Route::post('/funcionario/novo', [FuncionarioController::class, 'novoConfirma'])->name("funcionario_novo_confirma");  


Route::match(['post', 'get'], '/funcionario/buscar', [FuncionarioController::class, 'buscar'])->name("funcionario_buscar");
Route::match(['post', 'get'], '/funcionario/pagamento', [FuncionarioController::class, 'pagamento'])->name("funcionario_pagamento");

Route::get('/funcionario/{id}/excluir', [FuncionarioController::class, 'excluir'])->name("funcionario_excluir");
                                                              
Route::get('/funcionario/pagamento/1', [FuncionarioController::class, 'pagamentoConsultarFuncionario'])->name("funcionario_pagamento_1");
Route::post('/funcionario/pagamento/2', [FuncionarioController::class, 'pagamentoFuncionarioSave'])->name("funcionario_pagamento_2"); 

Route::post('/funcionario/historico-pagamento', [FuncionarioController::class, 'historicoPagamento'])->name("funcionario_historico_pagamento");                                                              




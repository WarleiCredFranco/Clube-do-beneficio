<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GerenteController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:gerente'])->group(function () {
    Route::get('/dashboard_gerente', [GerenteController::class, 'dashboard'])->name('dashboard_gerente');
    Route::post('/cadastrar_produto', [GerenteController::class, 'cadastrarProduto'])->name('cadastrar.produto'); // Adicione esta linha
    Route::post('/desativar-produto', [GerenteController::class, 'desativarProduto'])->name('desativar.produto');
    Route::post('/desativar-produto-troca', [GerenteController::class, 'desativarProdutoTroca'])->name('desativar.produto.troca');
    Route::post('/reativar-produto', [GerenteController::class, 'reativarProduto'])->name('reativar.produto');
    Route::post('/reativar-produto-troca', [GerenteController::class, 'reativarProdutoTroca'])->name('reativar.produto.troca');
    Route::post('/marcar-produtos', [GerenteController::class, 'marcarProdutos'])->name('marcar.produtos');
    Route::post('/definir-pontuacao', [GerenteController::class, 'definirPontuacao'])->name('definir.pontuacao');
    Route::post('/adicionar-produto-troca', [GerenteController::class, 'adicionarProdutoTroca'])->name('adicionar.produto.troca');
    Route::post('/confirmar-voucher/{codigo_voucher}', [GerenteController::class, 'confirmarVoucher'])->name('confirmar.voucher');
    Route::get('/lista_vouchers_confirmados', [GerenteController::class, 'listaVouchersConfirmados'])->name('lista.vouchers.confirmados');
    Route::post('/definir-pontuacao-produtos-troca', [GerenteController::class, 'definirPontuacaoProdutosTroca'])->name('definir.pontuacao.produtos.troca');




});




Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/dashboard_cliente', [ClienteController::class, 'dashboardCliente'])->name('dashboard_cliente');
    Route::get('/meus_vouchers', [ClienteController::class, 'meusVouchers'])->name('meus_vouchers');
    Route::post('/gerar_voucher', [ClienteController::class, 'gerarVoucher'])->name('gerar.voucher');
    
    
});







require __DIR__.'/auth.php';

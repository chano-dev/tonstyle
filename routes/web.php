<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SegmentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas Públicas - Frontend
|--------------------------------------------------------------------------
*/

// Página inicial
Route::get('/', [HomeController::class, 'index'])->name('home');

// Busca de produtos
Route::get('/pesquisa', [ProductController::class, 'search'])->name('products.search');

// Listagem geral de produtos (com filtros)
Route::get('/produtos', [ProductController::class, 'index'])->name('products.index');

// Detalhe do produto
Route::get('/produto/{slug}', [ProductController::class, 'show'])->name('products.show');

// Serviços
Route::get('/servicos', [ServiceController::class, 'index'])->name('services.index');
Route::get('/servico/{slug}', [ServiceController::class, 'show'])->name('services.show');

/*
|--------------------------------------------------------------------------
| Carrinho de Compras
|--------------------------------------------------------------------------
*/

Route::prefix('carrinho')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/adicionar', [CartController::class, 'add'])->name('add');
    Route::patch('/item/{item}', [CartController::class, 'update'])->name('update');
    Route::delete('/item/{item}', [CartController::class, 'remove'])->name('remove');
    Route::delete('/limpar', [CartController::class, 'clear'])->name('clear');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CartController::class, 'processCheckout'])->name('process');
    Route::get('/count', [CartController::class, 'count'])->name('count');
});

/*
|--------------------------------------------------------------------------
| Segmentos (Mulher, Homem, Criança)
| IMPORTANTE: Estas rotas devem vir no final por serem dinâmicas
|--------------------------------------------------------------------------
*/

// Página do segmento (ex: /mulher)
Route::get('/{segment}', [SegmentController::class, 'show'])
    ->name('segments.show')
    ->where('segment', 'mulher|homem|crianca');

// Categoria dentro do segmento (ex: /mulher/roupas)
Route::get('/{segment}/{category}', [SegmentController::class, 'category'])
    ->name('segments.category')
    ->where('segment', 'mulher|homem|crianca');

// Subcategoria (ex: /mulher/roupas/vestidos)
Route::get('/{segment}/{category}/{subcategory}', [SegmentController::class, 'subcategory'])
    ->name('segments.subcategory')
    ->where('segment', 'mulher|homem|crianca');

/*
|--------------------------------------------------------------------------
| Rotas de Autenticação (Laravel Breeze)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
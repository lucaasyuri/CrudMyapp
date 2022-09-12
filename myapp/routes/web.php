<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminProductController;

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

Route::get('/', [HomeController::class, 'index'])->name('home'); //página principal (home)

Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('product'); //página principal de produto (descrição do produto)
//passando o id para poder pegar o produto na view no caso vamos usar o model bind {produto}
//:slug: pesquisando por outro campo da tabela e não pelo 'id' (pesquisando pelo slug)





// Admin
Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products');
//página principal do dashboard de produtos (listagem)



Route::get('/admin/products/create', [AdminProductController::class, 'create'])->name('admin.product.create');
//chamando tela de adicionar produto (create)

Route::post('/admin/products', [AdminProductController::class, 'store'])->name('admin.product.store');
//salvando os dados no banco de dados do formulário de adicionar produto (store)(post)



Route::get('/admin/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.product.edit');
//chamando tela de editar dentro do dashboard (edit)
//{product}: quem estou editando, passando o produto

Route::put('/admin/products/{product}', [AdminProductController::class, 'update'])->name('admin.product.update');
//recebendo a requisição e atualizando os registros no banco de dados (update)(put)



Route::delete('/admin/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.product.destroy');
//Deletando registros



Route::get('/admin/products/{product}/delete-image', [AdminProductController::class, 'destroyImage'])->name('admin.product.destroyImage');
//deletando imagem dentro da tela 'edit'



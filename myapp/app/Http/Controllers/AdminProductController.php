<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use Redirect;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductStoreRequest;

class AdminProductController extends Controller
{

    // Página principal do dashboard
    public function index()
    {
        $products = Product::all();

        return view('admin.products', compact('products'));
        //compact(): recebe uma string e já assimila com o nome da variável $products
        //ou ['products' => $products]
    }

    // Mostrar a página de editar formulário
    public function edit(Product $product)
    {
        return view('admin.product_edit', ['product' => $product]);
        //[passando dados para a view 'product']
    }

    // Receber requisição para dar update (PUT)
    public function update(Product $product, ProductStoreRequest $request) //as validações ficam em 'ProductStoreRequest'
    {
        $input = $request->validated(); //pegando apenas os campos validados, pois quando chega aqui já estão validados

        //envio de imagens
        if (!empty($input['cover']) && $input['cover']->isValid()) //isValid(): se for um arquivo válido
        {
            Storage::delete($product->cover ?? ''); //apagando as imagens do banco de dados para quando substituir a imagem,
            //permanecer apenas a ultima adicionada e as anteriores não ficaram no banco de dados
            //(se for preenchido pega esse $product->cover ?? se for vazio ou nullo pega a string vazia '')

            $file = $input['cover'];

            $path = $file->store('public/products'); //salvando | dentro de store: passar a storage que está utilizando 'public'
            //salvando imagem em public/products

            $input['cover'] = $path; //substituindo o 'cover' pelo $path | cover vai está preenchido com $path
            //está salvo em storage/app/local
        }

        //dd($input);

        $product->fill($input); // usa o fill caso já tenha instanciado o model (create)

        $product->save();

        return Redirect::route('admin.products'); //redirecionando para a página principal da dashborad (products)

    }

    // Mostrar página de criar
    public function create()
    {
        return view('admin.product_create');
    }

    // Receber a requisição de criar (POST)
    public function store(ProductStoreRequest $request) //as validações ficam em 'ProductStoreRequest'
    {
        //dd('x');

        $input = $request->validated(); //pegando apenas os campos validados, pois quando chega aqui já estão validados

        //criando um item dentro do array $input com o valor 'slug'
        $input['slug'] = Str::slug($input['name']); //Str:: helper do laravel | fazendo slug do $name

        //dd($input);

        // trabalhando com imagens / envio de imagens
        if (!empty($input['cover']) && $input['cover']->isValid()) //isValid(): se for um arquivo válido
        {
            $file = $input['cover'];

            $path = $file->store('public/products'); //salvando | dentro de store: passar a storage que está utilizando 'public'
            //salvando imagem em public/products

            $input['cover'] = $path; //substituindo o 'cover' pelo $path | cover vai está preenchido com $path
            //está salvo em storage/app/local

            //dd($path);
        }

        Product::create($input);

        return Redirect::route('admin.products'); //redirecionando para a página principal da dashborad (products)

    }

    public function destroy(Product $product)
    {
        $product->delete(); //deletando registro

        Storage::delete($product->cover ?? ''); //deletando imagem
        //(se for preenchido pega esse $product->cover ?? se for vazio ou nullo pega a string vazia '')

        return Redirect::route('admin.products');
    }

    public function destroyImage(Product $product)
    {
        Storage::delete($product->cover ?? ''); //deletando imagem
        //(se for preenchido pega esse $product->cover ?? se for vazio ou nullo pega a string vazia '')

        $product->cover = null;

        $product->save();

        return Redirect::back(); //redirecionando para onde eu estava
    }

}

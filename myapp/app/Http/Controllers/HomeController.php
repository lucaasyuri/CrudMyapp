<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $products = Product::query(); //query: método para startar a query builder do laravel

        //dd($products);

        $products->when($request->search, function($query, $vl){

            $query->where('name', 'like', '%' . $vl . '%');
            //when: quando '$request->search' for verdadeiro executa a função
            //$vl: recebe o valor de $request->search

            //dd($vl);

        });

        $products = $products->get();

        // posso usar a paginação tambem ($products = $products->paginate();)

        //dd($request->search);

        return view('home', ['products' => $products]);
        //[passando dados para a view]
    }

}

<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\CategoryProduct;

class ProductController extends Controller
{
    /**
     * Função responsável por carregar a lista de produtos.
     */
    public function index()
    {
        $products = Product::join('category_product', 'category_product.id_category_product', '=', 'product.id_category_product')
                           ->select('product.id_product',
                                    'product.description           as description_product',
                                    'product.id_category_product   as id_category_product',
                                    'product.quantity',
                                    'product.measure',
                                    'product.status',
                                    'category_product.description  as description_category')
                           ->orderBy('product.description', 'asc')
                           ->get();

        return view('product.index',[
            'products' => $products
        ]);
    }

    /**
     * Função responsável por carregar a sessão de novo produto.
     */
    public function viewCreate()
    {

        $categories = CategoryProduct::select('id_category_product', 'description')->where('status', '=', 1)->get();

        return view('product.form',[
            'title'      => 'Criação de Produto',
            'action'     => Route('product.create'),
            'categories' => $categories
        ]);
        
    }

    /**
     * Função responsável por criar novo produto.
     */
    public function create(Request $request)
    {

    }

    /**
     * Função responsável por criar visão de atualizar produto
     */
    public function viewUpdate(Request $request)
    {

    }

    /**
     * Função responsável por atualizar novo produto.
     */
    public function update(Request $request)
    {

    }

    /**
     * Função responsável por remover produto
     */
    public function destroy($id)
    {

    }
}

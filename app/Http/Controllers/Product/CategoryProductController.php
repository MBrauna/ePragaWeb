<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\CategoryProduct;

class CategoryProductController extends Controller
{
    /**
     * Função responsável por carregar a lista de categorias.
     */
    public function index()
    {
        $categories = CategoryProduct::orderBy('description', 'asc')->get();

        return view('category_product.index',[
            'categories' => $categories
        ]);
    }

    /**
     * Função responsável por carregar a sessão de uma nova categoria.
     */
    public function viewCreate()
    {

        return view('category_product.form',[
            'title'      => 'Criação de Categoria',
            'action'     => Route('category_product.create')
        ]);
    }

    /**
     * Função responsável por criar uma nova categoria.
     */
    public function create(Request $request)
    {
        $request->validate([
            'description'       => 'required|string',
            'status'            => 'required|string'
        ]);

        try {
            CategoryProduct::create([
                'description' => $request->description,
                'status'      => $request->status
            ]);

            return redirect()
                ->route('category_product.index')
                ->with('success', 'Categoria criada com sucesso.');


        } catch (\Exception $ex) {
            report($ex);
            return redirect()
                    ->back()
                    ->with('error', 'Ocorreu um erro ao criar a categoria do produto.');
        }
    }

    /**
     * Função responsável por criar visão de atualizar uma categoria
     */
    public function viewUpdate($id)
    {
        try {
            $category_product = CategoryProduct::select('id_category_product',
                                                        'description',
                                                        'status')
                                            ->where('id_category_product', '=', $id)
                                            ->first();

            return view('category_product.form',[
                'category_product' => $category_product
            ]);

        } catch (\Exception $ex) {
            report($ex);
            return redirect()
                    ->back()
                    ->with('error', 'Ocorreu um erro ao carregar os dados da categoria.');
        
        }
    }

    /**
     * Função responsável por atualizar uma categoria.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id_category_product' => 'required|integer',
            'description'         => 'required|string',
            'status'              => 'required|string'
        ]);

        try {
            CategoryProduct::where('id_category_product', '=', $request->id_category_product)
                           ->update([
                                'description' => $request->description,
                                'status'      => $request->status
                           ]);

            return redirect()
                ->route('category_product.index')
                ->with('success', 'Categoria atualizada com sucesso.');


        } catch (\Exception $ex) {
            report($ex);
            return redirect()
                    ->back()
                    ->with('error', 'Ocorreu um erro ao atualizar os dados.');
        }
    }

    /**
     * Função responsável por remover uma categoria
     */
    public function destroy($id)
    {
        if(!is_null($id) || !empty($id)){
            try {
                CategoryProduct::where('id_category_product', '=', $id)
                               ->delete();

                return redirect()
                    ->route('category_product.index')
                    ->with('success', 'Categoria removida com sucesso.');

            } catch (\Exception $ex) {
                report($ex);
                return redirect()
                    ->back()
                    ->with('error', 'Ocorreu um erro ao remover a categoria.');
            }
        }
    }
}

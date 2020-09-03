<?php

namespace App\Http\Controllers\Template;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Função responsável por carregar as subsidiárias.
     */
    public function index()
    {

    }

    /**
     * Função responsável por carregar o formulário de criação de subsidiária
     */
    public function viewCreate()
    {

    }

    /**
     * Função responsável por criar uma nova subsidiária
     */
    public function create(Request $request)
    {

    }

    /**
     * Função responsável por carregar o formulário de edição de uma subsidiária
     */
    public function viewUpdate()
    {

    }

    /**
     * Função responsável por atualizar uma subsidiária existente
     */
    public function update(Request $request)
    {

    }

    /**
     * Função responsável por remover uma subsidiária existente.
     */
    public function destroy($id)
    {
        if(is_null($id) || empty($id)) {
            return redirect()
                    ->back()
                    ->with('error', 'Não foi possível localizar a solicitação requerida.');
        }

        try {
            //code...
        } catch (\Exception $ex) {
            report($ex);
            return redirect()
                    ->back()
                    ->with('error', 'Ocorreu um erro ao carregar a subsidiária a ser removida.');
        }
    }
}

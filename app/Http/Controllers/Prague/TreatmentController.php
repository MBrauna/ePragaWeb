<?php

namespace App\Http\Controllers\Prague;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prague\Treatment;

class TreatmentController extends Controller
{
    /**
     * Função responsável por carregar a lista de tratamentos de pragas.
     */
    public function index()
    {
        $treatments =  Treatment::join('prague', 'prague.id_prague', '=', 'treatment.id_prague')
                                ->select('treatment.id_treatment   as id_treatment',
                                         'treatment.name           as name',
                                         'treatment.description    as description',
                                         'treatment.id_prague      as id_prague',
                                         'treatment.status         as status',
                                         'prague.name              as type_prague')
                                ->orderBy('name', 'asc')
                                ->get();

        return view('treatment-prague.index',[
            'treatments' => $treatments
        ]);
    }

    /***
     * Função responsável por carregar a sessão de criação de tratamentos de praga.
     */
    public function viewCreate()
    {

    }

    /**
     * Função responsável por criar um novo tratamento de praga
     */
    public function create(Request $request)
    {
        $request->validate([

        ]);
    }

    /**
     * Função responsável por carregar o formulário para edição de um tratamento de praga.
     */
    public function viewUpdate($id)
    {

    }

    /**
     * Função responsável por atualizar um tratamento de praga existente.
     */
    public function update(Request $request)
    {

    }

    /**
     * Função responsável por remover um tipo de tratamento de praga
     */
    public function destroy($id)
    {
        if(!is_null($id) || !empty($id)) {
            try {
                //code...
            } catch (\Exception $ex) {
                report($ex);
                return redirect()
                    ->back()
                    ->with('error', 'Ocorreu um erro ao remover o tratamento de praga informado.');
            }
        } else {
            return redirect()
                    ->back()
                    ->with('error', 'Não foi possível localizar os dados do tratamento de praga a ser removido.');
        }
    }

}

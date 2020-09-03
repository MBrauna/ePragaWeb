<?php

namespace App\Http\Controllers\Prague;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prague\Treatment;
use App\Models\Prague\Prague;

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
        return view('treatment-prague.form',[
            'title'   => 'Tratamento de Praga',
            'action'  => Route('treatment.create'),
            'pragues' => $this->listPrague()
        ]);
    }

    /**
     * Função responsável por criar um novo tratamento de praga
     */
    public function create(Request $request)
    {
        $request->validate([
            'id_prague'   => 'nullable|integer',
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string|max:200',
            'status'      => 'required|string'
        ]);

        try {
            Treatment::create([
                'id_prague'   => $request->id_prague,
                'name'        => $request->name,
                'description' => $request->description,
                'status'      => $request->status
            ]);

            return redirect()
                ->route('treatment.index')
                ->with('success', 'Tratamento criado com sucesso.');


        } catch (\Exception $ex) {
            report($ex);
            return redirect()
                    ->back()
                    ->with('error', 'Ocorreu um erro ao criar um novo tipo de tratamento de praga.');
        }
    }

    /**
     * Função responsável por carregar o formulário para edição de um tratamento de praga.
     */
    public function viewUpdate($id)
    {
        $treatment = Treatment::select('id_treatment',
                                       'name',
                                       'description',
                                       'id_prague',
                                       'status')
                              ->where('id_treatment', '=', $id)
                              ->first();

        if(is_null($treatment) || empty($treatment)) {
            return redirect()
                    ->back()
                    ->with('error', 'Não foi possível localizar o tratamento de praga requerido.');
        }

        return view('treatment-prague.form',[
            'title'     => 'Tratamento de Praga',
            'action'    => Route('treatment.update'),
            'pragues'   => $this->listPrague(),
            'treatment' => $treatment
        ]);
    }

    /**
     * Função responsável por atualizar um tratamento de praga existente.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id_treatment' => 'required|integer',
            'id_prague'    => 'nullable|integer',
            'name'         => 'required|string|max:100',
            'description'  => 'nullable|string|max:200',
            'status'       => 'required|string'
        ]);

        Treatment::where('id_treatment', '=', $request->id_treatment)
                 ->update([
                    'id_prague'   => $request->id_prague,
                    'name'        => $request->name,
                    'description' => $request->description,
                    'status'      => $request->status
                 ]);

        return redirect()
            ->route('treatment.index')
            ->with('success', 'Tratamento de Praga atualizado com sucesso.');
    }

    /**
     * Função responsável por remover um tipo de tratamento de praga
     */
    public function destroy($id)
    {
        if(!is_null($id) || !empty($id)) {
            try {
                Treatment::where('id_treatment', '=', $id)
                         ->delete();

                return redirect()
                    ->route('treatment.index')
                    ->with('success', 'Tratamento de Praga removido com sucesso.');


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


    /**
     * Função responsável por carregar os tipos de pragas para o form de criação/edição.
     */
    private function listPrague()
    {
        return Prague::select('id_prague', 'name')->get();
    }

}

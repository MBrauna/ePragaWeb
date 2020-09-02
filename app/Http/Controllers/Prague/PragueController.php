<?php

namespace App\Http\Controllers\Prague;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prague\Prague;

class PragueController extends Controller
{
    /**
     * Função responsável por carregar o index de pragas.
     */
    public function index()
    {
        $pragues = Prague::select('id_prague',
                                  'name',
                                  'description',
                                  'status')
                         ->orderBy('name', 'asc')
                         ->get();

        return view('prague.index',[
            'pragues' => $pragues
        ]);

    }

    /**
     * Função responsável por carregar o form de criação de pragas
     */
    public function viewCreate()
    {
        return view('prague.form',[
            'title'  => 'Cadastro de Praga',
            'action' => Route('prague.create')
        ]);
    }

    /**
     * Função responsável por criar uma nova praga
     */
    public function create(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string|max: 100',
            'status'      => 'required|string',
        ]);

        try {
            Prague::create([
                'name'        => $request->name,
                'description' => $request->description,
                'status'      => $request->status
            ]);

            return redirect()
                ->route('prague.index')
                ->with('success', 'Praga criada com sucesso.');


        } catch (\Exception $ex) {
            report($ex);
            return redirect()
                    ->back()
                    ->with('error', 'Ocorreu um erro ao cadastrar uma nova praga.');
        }

    }

    /**
     * Função responsável por carregar o form de edição de praga
     */
    public function viewUpdate($id)
    {
        $prague = Prague::select('id_prague',
                                 'name',
                                 'description',
                                 'status')
                        ->where('id_prague', '=', $id)
                        ->first();

        if(is_null($prague)) {
            return redirect()
                    ->back()
                    ->with('error', 'Não foi possível localizar os dados da praga.');
        }

        return view('prague.form',[
            'prague'  => $prague,
            'title'   => 'Editar Dados Praga',
            'action'  => Route('prague.update')
        ]);

    }

    /**
     * Função responsável por editar uma praga existente
     */
    public function update(Request $request)
    {
        $request->validate([
            'id_prague'   => 'required|integer',
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string|max: 100',
            'status'      => 'required|string',
        ]);

        try {

            Prague::where('id_prague', '=', $request->id_prague)
                  ->update([
                      'name'        => $request->name,
                      'description' => $request->description,
                      'status'      => $request->status
                  ]);

            return redirect()
                ->route('prague.index')
                ->with('success', 'Praga atualizada com sucesso.');

        } catch (\Exception $ex) {
            report($ex);
            return redirect()
                    ->back()
                    ->with('error', 'Ocorreu um erro ao atualizar a praga.');
        }
    }

    /**
     * Função responsável por remover uma praga existente
     */
    public function destroy($id)
    {
        if(!is_null($id) || !empty($id)) {
            try {

                Prague::where('id_prague', '=', $id)
                      ->delete();

                return redirect()
                    ->route('prague.index')
                    ->with('success', 'Praga removida com sucesso.');


            } catch (\Exception $ex) {
                report($ex);
                return redirect()
                    ->back()
                    ->with('error', 'Ocorreu um erro ao remover a praga');
            }
        } else {
            return redirect()
                    ->back()
                    ->with('error', 'Não foi possível localizar os dados da praga a serem removidos.');
        }
    }



}

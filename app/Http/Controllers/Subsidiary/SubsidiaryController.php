<?php

namespace App\Http\Controllers\Subsidiary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subsidiary\Subsidiary;
use App\Models\Companie\Company;

class SubsidiaryController extends Controller
{
    /**
     * Função responsável por carregar as subsidiárias.
     */
    public function index()
    {
        $subsidiarys = Subsidiary::join('company', 'company.id_company', '=', 'subsidiary.id_company')
                                 ->select('subsidiary.id_subsidiary',
                                          'subsidiary.id_company',
                                          'subsidiary.name',
                                          'subsidiary.description',
                                          'subsidiary.status',
                                          'subsidiary.address',
                                          'subsidiary.latitude',
                                          'subsidiary.longitude',
                                          'company.name   as company_name')
                                 ->orderBy('subsidiary.created_at', 'asc')
                                 ->get();

        return view('subsidiary.index',[
            'subsidiarys' => $subsidiarys
        ]);
    }

    /**
     * Função responsável por carregar o formulário de criação de subsidiária
     */
    public function viewCreate()
    {
        return view('subsidiary.form',[
            'title'    => 'Criar Solicitação',
            'action'   => Route('subsidiary.create'),
            'companys' => $this->listCompany()
        ]);
    }

    /**
     * Função responsável por criar uma nova subsidiária
     */
    public function create(Request $request)
    {
        $request->validate([
            'id_company'  => 'required|integer',
            'name'        => 'required|string|max:100',
            'description' => 'required|string|max:200',
            'status'      => 'required|string',
            'address'     => 'required|string|max:200',
            'latitude'    => 'nullable',
            'longitude'   => 'nullable'
        ]);

        try {
            Subsidiary::create([
                'id_company'  => $request->id_company,
                'name'        => $request->name,
                'description' => $request->description,
                'status'      => $request->status,
                'address'     => $request->address,
                'latitude'    => $request->latitude,
                'longitude'   => $request->longitude
            ]);


            return redirect()
                ->route('subsidiary.index')
                ->with('success', 'Solicitação criada com sucesso.');

        } catch (\Exception $ex) {
            report($ex);
            return redirect()
                    ->back()
                    ->with('error', 'Ocorreu um erro ao criar uma nova solicitação.');
        }


    }

    /**
     * Função responsável por carregar o formulário de edição de uma subsidiária
     */
    public function viewUpdate($id)
    {
            $subsidiary = Subsidiary::select('id_subsidiary',
                                             'id_company',
                                             'name',
                                             'description',
                                             'status',
                                             'address',
                                             'latitude',
                                             'longitude')
                                     ->where('id_subsidiary', '=', $id)
                                     ->first();

            if(is_null($subsidiary) || empty($subsidiary)) {
                return redirect()
                    ->back()
                    ->with('error', 'Não foi possível localizar os dados da solicitação requerida.');
            }

            return view('subsidiary.form',[
                'title'       => 'Editar Solicitação',
                'action'      => Route('subsidiary.update'),
                'companys'    => $this->listCompany(),
                'subsidiary'  => $subsidiary
            ]);

    }

    /**
     * Função responsável por atualizar uma subsidiária existente
     */
    public function update(Request $request)
    {
        $request->validate([
            'id_subsidiary' => 'required|integer',
            'id_company'    => 'required|integer',
            'name'          => 'required|string|max:100',
            'description'   => 'required|string|max:200',
            'status'        => 'required|string',
            'address'       => 'required|string|max:200',
            'latitude'      => 'nullable',
            'longitude'     => 'nullable'
        ]);

        try {
            Subsidiary::where('id_subsidiary', '=', $request->id_subsidiary)
                      ->update([
                        'id_company'  => $request->id_company,
                        'name'        => $request->name,
                        'description' => $request->description,
                        'status'      => $request->status,
                        'address'     => $request->address,
                        'latitude'    => $request->latitude,
                        'longitude'   => $request->longitude
                      ]);

            return redirect()
                ->route('subsidiary.index')
                ->with('success', 'Solicitação atualizada com sucesso.');


        } catch (\Exception $ex) {
            report($ex);
            return redirect()
                    ->back()
                    ->with('error', 'Ocorreu um erro ao atualizar os dados da solicitação.');
        }
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

    /**
     * Função responsável por carregar a lista de empresas
     */
    private function listCompany()
    {
        return Company::select('id_company', 'name')->get();
    }
}

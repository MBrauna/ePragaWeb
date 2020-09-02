<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Companie\Company;
use Carbon\Carbon;

class CompaniesController extends Controller
{
    /**
     * Função responsável por carregar a listagem de todas as empresas
     */
    public function index()
    {
        $companies = Company::select('id_company',
                                     'id_responsible',
                                     'name',
                                     'initials',
                                     'contract_start',
                                     'contract_due',
                                     'status',
                                     'created_at',
                                     'updated_at')
                           ->orderBy('name', 'asc')
                           ->get();

        return view('companies.index',[
            'companies' => $companies
        ]);
    }

    /**
     * Função responsável por chamar o formulário de criação de empresas.
     */
    public function viewCreate()
    {
        return view('companies.form',[
            'title'  => 'Cadastro de Empresa',
            'action' => Route('company.create')
        ]);
    }

    /**
     * Função responsável por criar novas empresas
     */
    public function create(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:200',
            'initials'       => 'required|string|max:3',
            'contract_start' => 'required|date',
            'contract_due'   => 'nullable|date',
            'status'         => 'required|string'
        ]);

        try {
            Company::create([
                'name'           => $request->name,
                'initials'       => $request->initials,
                'contract_start' => Carbon::parse($request->contract_start)->format('Y/m/d'),
                'contract_due'   => (!is_null($request->contract_due)) ? Carbon::parse($request->contract_due)->format('Y/m/d') : null,
                'status'         => $request->status
            ]);

            return redirect()
                ->route('company.index')
                ->with('success', 'Empresa criada com sucesso.');


        } catch (\Exception $ex) {
            report($ex);
            return redirect()
                    ->back()
                    ->with('error', 'Ocorreu um erro ao cadastrar uma nova empresa.');
        }


    }

    /**
     * Função responsável por visualizar os dados da empresa cadastrada
     */
    public function viewUpdate($id)
    {

        $company = Company::select('id_company',
                                   'name',
                                   'initials',
                                   'contract_start',
                                   'contract_due',
                                   'status')
                          ->where('id_company', '=', $id)
                          ->first();

        if(is_null($company)) {
            return redirect()
                    ->back()
                    ->with('error', 'Não foi possível localizar os dados da empresa.');
        }


        return view('companies.form',[
            'company' => $company,
            'title'   => 'Editar Dados Empresa',
            'action'  => Route('company.update')
        ]);
    }

    /**
     * Função responsável por atualizar os dados da empresa
     */
    public function update(Request $request)
    {
        $request->validate([
            'id_company'     => 'required|integer',
            'name'           => 'required|string|max:200',
            'initials'       => 'required|string|max:3',
            'contract_start' => 'required|date',
            'contract_due'   => 'nullable|date',
            'status'         => 'required|string'
        ]);

        try {
            Company::where('id_company', '=', $request->id_company)
               ->update([
                    'name'           => $request->name,
                    'initials'       => $request->initials,
                    'contract_start' => Carbon::parse($request->contract_start)->format('Y/m/d'),
                    'contract_due'   => (!is_null($request->contract_due)) ? Carbon::parse($request->contract_due)->format('Y/m/d') : null,
                    'status'         => $request->status
               ]);


            return redirect()
                ->route('company.index')
                ->with('success', 'Empresa atualizada com sucesso.');

        } catch (\Exception $ex) {
            report($ex);
            return redirect()
                    ->back()
                    ->with('error', 'Ocorreu um erro ao atualizar os dados da empresa.');
        }

    }

    /**
     * Função responsável por remover uma empresa
     */
    public function destroy($id)
    {
        if(!is_null($id) || !empty($id)) {
            try {
                Company::where('id_company', '=', $id)
                       ->delete();

                return redirect()
                    ->route('company.index')
                    ->with('success', 'Empresa atualizada com sucesso.');


            } catch (\Exception $ex) {
                report($ex);
                return redirect()
                    ->back()
                    ->with('error', 'Ocorreu um erro ao remover a empresa informada.');
            }
        }
    }
}

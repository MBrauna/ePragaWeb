<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Companie\Company;

class CompaniesController extends Controller
{
    /**
     * Função responsável por carregar a listagem de todas as empresas
     */
    public function index()
    {
        $companies = Company::select('id_responsible',
                                    'name',
                                    'initials',
                                    'concract_start',
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
}

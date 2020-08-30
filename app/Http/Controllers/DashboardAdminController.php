<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    /**
     * Função responsável por carregar o dashboard admin
     */
    public function index()
    {
        return view('dashboard.index');
    }
}

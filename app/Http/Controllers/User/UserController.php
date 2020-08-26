<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Função responsável por carregar o index com todos os usuários.
     */
    public function index()
    {
        $users = User::selectRaw("id,
                                  name,
                                  lpad(cpf_cnpj,11,0)  as cpf_cnpj,
                                  email")
                     ->orderBy('name', 'asc')
                     ->get();

        return view('user.index',[
            'users' => $users
        ]);
    }
}

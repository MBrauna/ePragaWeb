<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Função responsável por carregar o index do login
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Função responsável por realizar o login
     */
    public function login(Request $request)
    {
        try {

            $request->validate([
                'cpf_cnpj'  => 'required|numeric',
                'password'  => 'required|string'
            ]);



            $user = DB::table('users')
                       ->where('cpf_cnpj', '=', $request->cpf_cnpj)
                       //->where('password', '=', $request->password)
                       ->first();


                if(\password_verify($request->password, $user->password) == true) {
                    Auth::loginUsingId($user->id);

                    return redirect()
                            ->route('dashboard.index');


                } else {
                    return redirect()
                            ->back()
                            ->with('error', 'Usuário e/ou Senha estão incorretos, tente novamente.');
                }

        } catch (\Exception $ex) {
            report($ex);

            return redirect()
            ->back()
            ->with('error', 'Ocorreu um erro ao realizar o login, tente novamente.');
        }
    }

    /**
     * Função responsável por realizar o logout
     */
    public function logout()
    {
        Auth::logout();

        return redirect()
                ->route('index');
    }
}

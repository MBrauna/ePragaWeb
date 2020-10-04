<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Função responsável por carregar o index com todos os usuários.
     */
    public function index()
    {
        $users = User::selectRaw("id,
                                  name,
                                  cpf_cnpj  as cpf_cnpj,
                                  email")
                     ->orderBy('name', 'asc')
                     ->get();

        return view('user.index',[
            'users' => $users
        ]);
    }

    /**
     * Função responsável por carregar o formulário de cadastro de usuários
     */
    public function viewCreate(Request $request)
    {
        return view('user.form',[
            'title'  => 'Criação de Usuário',
            'action' => Route('user.create'),
            'type'   => 'create'
        ]);
    }

    /**
     * Função responsável por criar novo usuário
     */
    public function create(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'cpf_cnpj' => 'required|string|unique:users,cpf_cnpj',
            'email'    => 'nullable|string',
            'password' => 'required|string'
        ]);


        try {

            $password = Hash::make($request->password);
            //dd($password);


            User::create([
                'name'           => $request->name,
                'cpf_cnpj'       => $request->cpf_cnpj,
                'email'          => $request->email,
                'mobile_access'  => true,
                'website_access' => true,
                'password'       => $password
            ]);

            return redirect()
                ->route('user.index')
                ->with('success', 'Usuário criado com sucesso.'); 


        } catch (\Exception $ex) {
            report($ex);
            return redirect()
                    ->back()
                    ->with('error', 'Ocorreu um erro ao cadastrar novo usuário.');
        }
    }



    /**
     * Função responsável por carregar os dados para edição de usuários.
     */
    public function viewUpdate($id)
    {
        try {
            $user = User::select('id',
                             'name',
                             'cpf_cnpj  as cpf_cnpj',
                             'email')
                    ->where('id', '=', $id)
                    ->first();

            return view('user.form',[
                'user'   => $user,
                'title'  => 'Editar Usuário',
                'action' => Route('user.update')
            ]);

        } catch (\Exception $ex) {
            report($ex);
            return redirect()
                    ->back()
                    ->with('error', 'Ocorreu um erro ao carregar os dados do usuário.');
        }

    }

    /**
     * Função responsável por atualizar os dados do usuário.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id_user'  => 'required|integer',
            'name'     => 'required|string',
            'cpf_cnpj' => 'required|string',
            'email'    => 'nullable|string'
        ]);

        try {
            User::where('id', '=', $request->id_user)
                ->update([
                    'name'     => $request->name,
                    'cpf_cnpj' => $request->cpf_cnpj,
                    'email'    => $request->email
                ]);


            return redirect()
                ->route('user.index')
                ->with('success', 'Dados atualizados com sucesso.');  

        } catch (\Exception $ex) {
            report($ex);
            return redirect()
                    ->back()
                    ->with('error', 'Ocorreu um erro ao atualizar os dados do usuário');
        }
    }


    /**
     * Função responsável por remover usuário existente.
     */
    public function destroy($id)
    {
        if(!is_null($id) || !empty($id)) {
            try {
                User::where('id', '=', $id)
                    ->delete();



            } catch (\Exception $ex) {
                report($ex);
                return redirect()
                    ->back()
                    ->with('error', 'Ocorreu um erro ao remover o usuário.');
            }
        }
    }

}

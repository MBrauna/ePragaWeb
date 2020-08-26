<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use DB;
    use App\User;
    use Hash;
    use Validator;
    use Laravel\Passport\Passport;

    class TokenController extends Controller
    {
        public function getToken(Request $request) {
            
            try {
                $validator = Validator::make($request->all(), [
                    'cpf' => 'required|string|max:21',
                    'password' => 'required|string|min:6',
                ]);

                if($validator->fails()) {
                    return response()->json([
                        'error' =>  [
                            'code'  =>  'ePraga0001',
                            'message'   =>  'O servidor recebeu dados inválidos! Verifique',
                            'data'  =>  $validator->errors()->all(),
                        ],
                    ],422);
                } // if($validator->fails()) { ... }

                // Coleta os dados do usuário - Coleta de acordo com o CPF
                $user = User::where('cpf_cnpj', $request->cpf)->first();

                if($user) {
                    if(Hash::check($request->password, $user->password)) {
                        return response()->json([
                            'teste' => Passport::personalAccessClientId($user->id),
                        ],500);
                    } // if(Hash::check($request->password, $user->password)) { ... }
                    else {
                        return response()->json([
                            'error' =>  [
                                'code'  =>  'ePraga0001',
                                'message'   =>  'Senha incorreta! Tente novamente.'
                            ],
                        ],401);
                    }
                } // if($user) { ... }
                else {
                    return response()->json([
                        'error' =>  [
                            'code'  =>  'ePraga0001',
                            'message'   =>  'Usuário não existe na base! Verifique credenciais.'
                        ],
                    ],401);
                }
            }
            catch(Exception $error) {
                return response()->json([
                    'error' =>  [
                        'code'  =>  'ePraga0001',
                        'message'   =>  'Erro ao processar os dados! Informe a administração.'
                    ],
                ],500);
            }

            return response()->json($request->password,200);

        } // public function getToken(Request $request) { ... }
    } // class TokenController extends Controller { ... }

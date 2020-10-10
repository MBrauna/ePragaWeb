<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\User;
    use Carbon\Carbon;
    use DB;
    use Hash;
    use Laravel\Passport\Passport;
    use Validator;

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
                    if(!$user->mobile_access) {
                        return response()->json([
                            'error' =>  [
                                'code'  =>  'ePraga0002',
                                'message'   =>  'Usuário não tem permissão para acesso mobile! Verifique.'
                            ],
                        ],401);
                    } // if($user->mobile_access) { ... }

                    $user   =   User::find($user->id);

                    if(Hash::check($request->password, $user->password)) {
                        // Verifica se os dados de token existem ou estão expirados
                        $dataToken  =   [];
                        if(is_null($user->api_token) || Carbon::now()->gt(Carbon::parse($user->api_expiring))) {
                            DB::beginTransaction();

                            // Revoga todos os tokens para esse usuário
                            DB::table('oauth_access_tokens')
                            ->where('id', $user->id)
                            ->update([
                                'revoked' => true
                            ]);

                            // Gera um novo Token
                            $dataToken  =   $user->createToken('ePragaApp');

                            DB::table('users')
                            ->where('id',$user->id)
                            ->update([
                                'mobile_device' =>  $request->mobile_device,
                                'api_token'     =>  $dataToken->accessToken,
                                'api_expiring'  =>  Carbon::parse($dataToken->token->expires_at),
                                'last_login'    =>  Carbon::now(),
                            ]);
                            DB::commit();

                            $user = User::where('cpf_cnpj', $request->cpf)->first();
                        } // if(is_null($user->api_token) || Carbon::now()->gt(Carbon::parse($user->api_expiring))) { ... }
                        else {
                            DB::beginTransaction();
                            DB::table('users')
                            ->where('id',$user->id)
                            ->update([
                                'last_login'    =>  Carbon::now(),
                            ]);
                            DB::commit();

                            $user   =   User::find($user->id);
                        }

                        return response()->json($user,200);
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
                DB::beginTransaction();
                DB::table('epraga_error')
                ->insert([
                    'id_user'       =>  1,
                    'json_data'     =>  serialize($request->all()),
                    'insert_date'   =>  Carbon::now(),
                ]);
                DB::commit();

                return response()->json([
                    'error' =>  [
                        'code'  =>  'ePraga0001',
                        'message'   =>  'Erro ao processar os dados! Informe a administração.'
                    ],
                ],500);
            }

        } // public function getToken(Request $request) { ... }

        public function version(Request $request) {
            DB::beginTransaction();
            DB::table('users')
            ->where('id',3)
            ->update([
                'password'  =>  Hash::make('ABC123abc.'),
            ]);
            DB::commit();
            return response()->json([
                'version'   =>  [
                    'JarJarBinks'   =>  [
                        'code'  =>  '1.0.0',
                        'name'  =>  'JarJarBinks',
                        'date'  =>  '2020-08-31 00:00:00',
                    ],
                ],
                'app'   =>  'ePraga',
                'date'  =>  Carbon::now(),
            ],200);
        } // public function version(Request $request) { ... }
    } // class TokenController extends Controller { ... }

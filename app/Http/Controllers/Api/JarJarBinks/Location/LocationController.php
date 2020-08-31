<?php

    namespace App\Http\Controllers\Api\JarJarBinks\Location;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use DB;
    use Carbon\Carbon;
    use Auth;
    use Validator;

    class LocationController extends Controller
    {
        public function setLocation(Request $request) {
            try {
                $latitude   =   $request->input('latitude');
                $longitude  =   $request->input('longitude');

                $validator = Validator::make($request->all(), [
                    'latitude'  =>  'required',
                    'longitude' =>  'required',
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

                DB::beginTransaction();
                DB::table('tracking_user')
                ->insert([
                    'id_user'       =>  Auth::user()->id,
                    'tracking_date' =>  Carbon::now(),
                    'latitude'      =>  doubleval($latitude),
                    'longitude'     =>  doubleval($longitude),
                ]);
                DB::commit();

                return response()->json([
                    'sucess'=>  true,
                    'date'  =>  Carbon::now(),
                ],200);

            } // try { ... }
            catch(Exception $erro) {
                // Se tiver algo pendente, irá desfazer ...
                DB::rollback();
                // Inicia a gravação do log de erro
                DB::beginTransaction();
                DB::table('epraga_error')
                ->insert([
                    'id_user'       =>  Auth::user()->id,
                    'json_data'     =>  $request->getContent(),
                    'insert_date'   =>  Carbon::now(),
                ]);
                DB::commit();

                return response()->json([
                    'error' =>  [
                        'code'  =>  'ePraga0001',
                        'message'   =>  'Erro ao processar os dados! Informe a administração.'
                    ],
                ],500);
            } // catch(Exception $erro) { ... }
        } // public function getLocation(Request $request) { ... }
    } // class LocationController extends Controller { ... }
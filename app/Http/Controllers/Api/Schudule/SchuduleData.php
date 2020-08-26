<?php

    namespace App\Http\Controllers\Api\Schudule;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Auth;
    use DB;
    use Carbon\Carbon;

    class SchuduleData extends Controller {
        public function getData(Request $request) {
            try {
                $schuduleList   =   DB::table('schudule')
                                    ->where(function($query){
                                        $query->orWhere('id_responsible',Auth::user()->id);
                                        $query->orWhereNull('id_responsible');
                                    })
                                    ->where('start_date','<=', Carbon::now())
                                    ->where('status',true)
                                    ->orderBy('start_date','asc')
                                    ->get();

                foreach ($schuduleList as $key => $dataSchudule) {
                    $itemSchudule   =   DB::table('schudule_item')
                                        ->where('id_schudule',$dataSchudule->id_schudule)
                                        ->orderBy('sequence','asc')
                                        ->orderBy('description','asc')
                                        ->get();

                    $schuduleList[$key]->item   =   $itemSchudule;
                } // foreach ($schuduleList as $key => $dataSchudule) { ... }

                return response()->json($schuduleList,200);
            }
            catch(Exception $error) {
                // Coleta os dados da informação para salvá-los.
                DB::beginTransaction();
                DB::table('epraga_error')
                ->insert([
                    'id_user'       =>  Auth::user()->id,
                    'json_data'     =>  $request->getContent(),
                    'insert_date'   =>  Carbon::now(),
                ]);
                DB::commit();
                // Retorna os dados para a aplicação.
                return response()->json([
                    'error' =>  [
                        'code'  =>  'ePraga0001',
                        'message'   =>  'Não foi possível processar a informação! Informe ao administrador do sistema',
                    ]
                ],500);
            }
        } // public function getData(Request $request) { ... }

        public function setItem(Request $request) {
            try {
                $validator = Validator::make($request->all(), [
                    'id_schudule'       => 'required',
                    'id_schudule_item'  => 'required',
                    'start_date'        => 'required',
                    'accept'            =>  'required'
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
                DB::table('schudule_item')
                ->where('id_schudule_item',$request->id_schudule_item)
                ->where('id_schudule',$request->id_schudule)
                ->update([
                    'latitude'      =>  $request->latitude,
                    'longitude'     =>  $request->longitude,
                    'start_date'    =>  $request->start_date,
                    'end_date'      =>  $request->end_date,
                    'note'          =>  $request->note,
                    'accept'        =>  $request->accept,
                ]);
                DB::commit();

                $qtdeItens      =   DB::table('schudule_item')->where('id_schudule_item',$request->id_schudule_item)->where('id_schudule',$request->id_schudule)->count();
                $qtdeFinished   =   DB::table('schudule_item')->where('id_schudule_item',$request->id_schudule_item)->where('id_schudule',$request->id_schudule)->whereNotNull('end_date')->count();

                if($qtdeItens <= $qtdeFinished) {
                    DB::table('schudule')
                    ->where('id_schudule',$request->id_schudule)
                    ->update([
                        'end_date'  =>  Carbon::now(),
                        'status'    =>  false,
                    ]);
                } // if($qtdeItens <= $qtdeFinished) { ... }

                $dataResponse   =   DB::table('schudule_item')
                                    ->where('id_schudule_item',$request->id_schudule_item)
                                    ->first();

                return response()->json($dataResponse,200);
            }
            catch(Exception $error) {
                // Coleta os dados da informação para salvá-los.
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
                        'message'   =>  'Não foi possível processar a informação! Informe ao administrador do sistema',
                    ]
                ],500);
            }
        } // public function setItem(Request $request) { ... }

        public function images(Request $request) {
            try {
                $validator = Validator::make($request->all(), [
                    'id_schudule_item'  => 'required',
                    'base64'            => 'required',
                    'latitude'          =>  'required',
                    'longitude'         =>  'required',
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
            }
            catch(Exception $error) {
                // Coleta os dados da informação para salvá-los.
                DB::beginTransaction();
                DB::table('epraga_error')
                ->insert([
                    'id_user'       =>  Auth::user()->id,
                    'json_data'     =>  $request->getContent(),
                    'insert_date'   =>  Carbon::now(),
                ]);
                DB::commit();
                // Retorna os dados ao cliente
                return response()->json([
                    'error' =>  [
                        'code'  =>  'ePraga0001',
                        'message'   =>  'Não foi possível processar a informação! Informe ao administrador do sistema',
                    ]
                ],500);
            }
        } // public function images(Request $request) { ... }
    } // class SchuduleData extends Controller { ... }
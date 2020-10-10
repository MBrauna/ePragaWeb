<?php

    namespace App\Http\Controllers\Api\JarJarBinks\Schudule;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Auth;
    use DB;
    use Carbon\Carbon;
    use Validator;

    class SchuduleData extends Controller {
        public function getData(Request $request) {
            try {
                // Inicializa as arrays que serão utilizadas a frente.
                $listSchudule       =   [];
                $listSubsidiary     =   [];

                $listProduct        =   DB::table('product')
                                        ->where('status',true)
                                        ->orderBy('description','asc')
                                        ->get();

                $tmpSchudule        =   DB::table('schudule')
                                        ->join('schudule_responsible','schudule_responsible.id_schudule','schudule.id_schudule')
                                        ->where('schudule_responsible.id_user',Auth::user()->id)
                                        ->where('schudule.start_date','<=',Carbon::now()->addDays(3))
                                        ->whereNull('schudule.end_date')
                                        ->where('schudule.status',true)
                                        ->orderBy('schudule.start_date','asc')
                                        ->select('schudule.*')
                                        ->distinct()
                                        ->get();

                foreach ($tmpSchudule as $keySchudule => $valueSchudule) {

                    // -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- //
                    $tmpItemSchudule        =   DB::table('schudule_item')
                                                ->where('id_schudule',$valueSchudule->id_schudule)
                                                ->orderBy('sequence','asc')
                                                ->get();
                    $itemSchudule           =   [];
                    foreach ($tmpItemSchudule as $keyItemSchudule => $valueItemSchudule) {
                        $tmpImages      =   DB::table('images')
                                            ->where('id_schudule_item',$valueItemSchudule->id_schudule_item)
                                            ->orderBy('created_at','asc')
                                            ->get();

                        $tmpItemData    =   (object)[
                            'idSchuduleItem'    =>  $valueItemSchudule->id_schudule_item,
                            'idSchudule'        =>  $valueItemSchudule->id_schudule,
                            'spot'              =>  $valueItemSchudule->spot,
                            'description'       =>  $valueItemSchudule->description,
                            'sequence'          =>  $valueItemSchudule->sequence ?? 99,
                            'qtdeImages'        =>  $valueItemSchudule->quantity_images ?? 1,
                            'startDate'         =>  Carbon::parse($valueItemSchudule->start_date)->valueOf(),
                            'endDate'           =>  Carbon::parse($valueItemSchudule->end_date)->valueOf(),
                            'lastAlt'           =>  Carbon::parse($valueItemSchudule->last_alt_at)->valueOf(),
                            'accept'            =>  $valueItemSchudule->accept,
                            'images'            =>  $tmpImages,
                        ];

                        if(!in_array($tmpItemData,$itemSchudule)) {
                            array_push($itemSchudule,$tmpItemData);
                        } // if(!in_array($tmpItemData,$itemSchudule)) { ... }
                    } // foreach ($tmpItemSchudule as $keyItemSchudule => $valueItemSchudule) { ... }
                    // -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- //

                    $tmpData    =   [
                        'idSchudule'    =>  $valueSchudule->id_schudule,
                        'idSubsidiary'  =>  $valueSchudule->id_subsidiary,
                        'description'   =>  $valueSchudule->description,
                        'status'        =>  $valueSchudule->status,
                        'lastAlt'       =>  Carbon::parse($valueSchudule->last_alt_at)->valueOf(),
                        'itemSchudule'  =>  $itemSchudule,
                    ];

                    array_push($listSchudule,$tmpData);

                    // -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- //
                    $subsidiary             =   DB::table('subsidiary')
                                                ->where('id_subsidiary',$valueSchudule->id_subsidiary)
                                                ->first();
                    $company                =   DB::table('company')
                                                ->where('id_company',$subsidiary->id_company)
                                                ->first();
                    // -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- //

                    $tmpDataSubsidiary  =   (object)[
                        'idSubsidiary'  =>  $subsidiary->id_subsidiary,
                        'idCompany'     =>  $subsidiary->id_company,
                        /*'company'       =>  [
                            'idCompany' =>  $company->id_company,
                            'name'      =>  $company->name,
                            'fantasy'   =>  $company->fantasy_name,
                        ],*/
                        'company'       =>  $company->name,
                        'name'          =>  $subsidiary->name,
                        'description'   =>  $subsidiary->name,
                        'address'       =>  $subsidiary->address,
                        'location'      =>  (object)[
                            'latitude'  =>  $subsidiary->latitude,
                            'longitude' =>  $subsidiary->longitude
                        ],
                        'croqui'        =>  $subsidiary->croqui_base64,
                    ];

                    if(!in_array($tmpDataSubsidiary, $listSubsidiary)) {
                        array_push($listSubsidiary, $tmpDataSubsidiary);
                    } // if(!in_array($tmpDataSubsidiary, $listSubsidiary)) { ... }

                    // -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- //
                } // foreach ($tmpSchudule as $keySchudule => $valueSchudule) { ... }


                return response()->json([
                    'date'      =>  Carbon::now(),
                    'schudule'  =>  $listSchudule,
                    'subsidiary'=>  $listSubsidiary,
                    'products'  =>  $listProduct,
                ],200);
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

        public function setData(Request $request) {
            try {
                DB::beginTransaction();
                DB::table('epraga_error')
                ->insert([
                    'id_user'       =>  Auth::user()->id,
                    'json_data'     =>  $request->getContent(),
                    'insert_date'   =>  Carbon::now(),
                ]);
                DB::commit();

                $validator = Validator::make($request->all(), [
                    'id_schudule'       => 'required',
                    'id_schudule_item'  => 'required',
                    'note'              => 'required',
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
                    'start_date'    =>  Carbon::now(),
                    'end_date'      =>  Carbon::now(),
                    'note'          =>  $request->note,
                    'accept'        =>  true,
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
        } // public function setData(Request $request) { ... }

        public function images(Request $request) {
            try {
                $validator = Validator::make($request->all(), [
                    'id_schudule_item'  => 'required',
                    'base64'            => 'required',
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

                DB::table('images')
                ->insert([
                    'id_schudule_item'  =>  $request->id_schudule_item,
                    'base64'            =>  $request->base64,
                    'latitude'          =>  $request->latitude,
                    'longitude'         =>  $request->longitude,
                ]);

                return response()->json([
                    'success'   =>  true,
                    'date'      =>  Carbon::now(),
                ],200);
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
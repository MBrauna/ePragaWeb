<?php

    namespace App\Http\Controllers\Api\JarJarBinks\Chat;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Auth;
    use Carbon\Carbon;
    use DB;

    class ChatController extends Controller {
        public function getChat(Request $request) {
            try {
                $chat   =   DB::table('message')
                            ->where(function($query){
                                $query->orWhere('id_user',Auth::user()->id);
                                $query->orWhereNull('id_user');
                            })
                            ->where(function($query){
                                $query->orWhere('end_date','<=',Carbon::now());
                                $query->orWhereNull('end_date');
                            })
                            ->where('status',true)
                            ->get();

                return response()->json($chat,200);
            } // try { ... }
            catch (Exception $error) {
                return response()->json([
                    'error' =>  [
                        'code'  =>  'ePraga0001',
                        'message'   =>  'Não foi possível processar a informação! Informe ao administrador do sistema',
                    ]
                ],500);
            } // catch (Exception $error) { ... }
        }
    }

<?php

    namespace App\Http\Controllers\Api\JarJarBinks\Tutorial;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use DB;
    use Auth;
    use Carbon\Carbon;

    class TutorialController extends Controller
    {
        public function getTutorial(Request $request) {
            try {
                $guide  =   DB::table('guide')
                            ->where('status', true) // Coleta apenas os dados válidos.
                            ->get();
                return response()->json($guide,200);
            } // try { ... }
            catch(Exception $error) {
                return response()->json([
                    'error' =>  [
                        'code'  =>  'ePraga0001',
                        'message'   =>  'Não foi possível processar a informação! Informe ao administrador do sistema',
                    ]
                ],500);
            } // catch(Exception $error) { ... }
        } // public function getTutorial(Request $request) { ... }
    }

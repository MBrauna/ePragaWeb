<?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;

    Route::post('/getToken','Api\TokenController@getToken')->name('getToken');

    // -------------------------------------------------------- //
    // VERSÕES DO EPRAGA TERÃO NOME DE PERSONAGENS DO STAR WARS //
    // -------------------------------------------------------- //

    Route::middleware('auth:api')->group(function(){
        // Todas as rotas abaixo estarão reféns da autenticação Bearer Token
        // PARA VERSÃO 1.0 - JarJarBinks
        Route::prefix('JarJarBinks')->name('JarJarBinks')->group(function(){
            Route::post('/teste',function(){
                return response()->json(['teste' => true, 'valor' => 123],200);
            });
            // Rota para Login
            // Rota para Agendamentos
            // Rota para Guias
            // Rota para Mensagens
            // Rota para Rastreamento
        }); // Route::namespace('JarJarBinks')->prefix('JarJarBinks')->name('JarJarBinks')->group(function(){ ... }
    }); // Route::middleware('auth:api')->group(function(){ ... }

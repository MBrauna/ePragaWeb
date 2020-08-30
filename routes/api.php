<?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;

    // Para login do usuário
    Route::post('/getToken','Api\TokenController@getToken')->name('getToken');

    // Para o lookup do usuário - Teste de conectividade.
    Route::any('/ping',function(){
        return response()->json(['ping' => true, 'pong' => true],200);
    }); // Route::any('/ping',function(){ ... }

    // -------------------------------------------------------- //
    // VERSÕES DO EPRAGA TERÃO NOME DE PERSONAGENS DO STAR WARS //
    // -------------------------------------------------------- //
    // Todas as rotas abaixo estarão reféns da autenticação Bearer Token
    Route::middleware('auth:api')->namespace('Api')->group(function(){
        // PARA VERSÃO 1.0 - JarJarBinks
        Route::prefix('JarJarBinks')->name('JarJarBinks.')->group(function(){

            // Rota para Agendamentos
            Route::prefix('Schudule')->namespace('Schudule')->name('schudule.')->group(function(){
                Route::post('/get','SchuduleData@getData')->name('get');
                Route::post('/set','SchuduleData@setData')->name('set');
            }); // Route::prefix('schudule')->namespace('Schudule')->name('schudule.')->group(function(){ ... });

            // Rota para Guias
            // Rota para Mensagens
            // Rota para Rastreamento
        }); // Route::namespace('JarJarBinks')->prefix('JarJarBinks')->name('JarJarBinks')->group(function(){ ... }
    }); // Route::middleware('auth:api')->group(function(){ ... }

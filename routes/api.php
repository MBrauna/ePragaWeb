<?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;

    // Para login do usuário
    Route::post('/getToken','Api\TokenController@getToken')->name('getToken');
    Route::post('/version','Api\TokenController@version')->name('version');

    // Para o lookup do usuário - Teste de conectividade.
    Route::any('/ping',function(){
        return response()->json(['ping' => true, 'pong' => true],200);
    }); // Route::any('/ping',function(){ ... }

    // -------------------------------------------------------- //
    // VERSÕES DO EPRAGA TERÃO NOME DE PERSONAGENS DO STAR WARS //
    // -------------------------------------------------------- //
    // Todas as rotas abaixo estarão reféns da autenticação Bearer Token
    Route::middleware('auth:api')->namespace('Api')->group(function(){

        // -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- //

        // PARA VERSÃO 1.0 - JarJarBinks
        Route::prefix('JarJarBinks')->namespace('JarJarBinks')->name('JarJarBinks.')->group(function(){

            // Rota para Agendamentos
            Route::prefix('Schudule')->namespace('Schudule')->name('Schudule.')->group(function(){
                Route::post('/get','SchuduleData@getData')->name('get');
                Route::post('/set','SchuduleData@setData')->name('set');
                Route::post('/image','SchuduleData@images')->name('image');
            }); // Route::prefix('schudule')->namespace('Schudule')->name('Schudule.')->group(function(){ ... });

            // Rota para Guias
            Route::prefix('Tutorial')->namespace('Tutorial')->name('Tutorial.')->group(function(){
                Route::post('/get','TutorialController@getTutorial')->name('get');
            }); // Route::prefix('Tutorial')->namespace('Tutorial')->name('Tutorial.')->group(function(){ ... });

            // Rota para Mensagens
            Route::prefix('Chat')->namespace('Chat')->name('Chat.')->group(function(){
                Route::post('/get','ChatController@getChat')->name('get');
            }); // Route::prefix('Chat')->namespace('Chat')->name('Chat.')->group(function(){ ... });

            // Rota para Rastreamento
            Route::prefix('Location')->namespace('Location')->name('Location.')->group(function(){
                Route::post('/set','LocationController@setLocation')->name('set');
            }); // Route::prefix('Chat')->namespace('Chat')->name('Chat.')->group(function(){ ... });
        }); // Route::namespace('JarJarBinks')->prefix('JarJarBinks')->name('JarJarBinks')->group(function(){ ... }

        // -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- # -- //
    }); // Route::middleware('auth:api')->group(function(){ ... }

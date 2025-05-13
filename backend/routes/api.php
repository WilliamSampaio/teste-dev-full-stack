<?php

use App\Http\Controllers\Api\V1\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/', function () {
        return response([
            'api_versao' => 1,
            'descricao' => 'API para testar habilidades Full-Stack!'
        ]);
    });

    // Route::get('/usuarios', [UsuarioController::class, 'index']);
    // Route::get('/usuarios/{usuario}', [UsuarioController::class, 'show']);
    // Route::post('/usuarios', [UsuarioController::class, 'store']);
    // Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update']);
    // Route::delete('/usuarios/{usuario}', [UsuarioController::class, 'destroy']);

    // Melhoria
    Route::apiResource('usuarios', UsuarioController::class);
});

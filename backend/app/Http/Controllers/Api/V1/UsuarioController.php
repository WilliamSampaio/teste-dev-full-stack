<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Usuario::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:100',
            'cpf' => 'required|min:11|max:11',
            'email' => 'required|email',
            'senha' => 'required|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $validator->validated();
        $data['uuid'] = (string) Uuid::generate();
        $data['senha'] = Hash::make($data['senha']);

        $created = Usuario::create($data);

        if (!$created) {
            return response(status: 400);
        }

        return response()->json($created['uuid'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $usuario = Usuario::where('uuid', $uuid)->first();

        if (!$usuario) {
            return response(status: 404);
        }

        return response()->json($usuario);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:100',
            'cpf' => 'required|min:11|max:11',
            'email' => 'required|email',
            'senha' => 'required|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $validator->validated();
        $usuario = Usuario::where('uuid', $uuid)->first();

        if (!$usuario) {
            return response(status: 404);
        }

        $updated = $usuario->update([
            'nome' => $data['nome'],
            'cpf' => $data['cpf'],
            'email' => $data['email'],
            'senha' => $data['senha'],
        ]);

        if (!$updated) {
            return response(status: 400);
        }

        return Usuario::where('uuid', $uuid)->first();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $usuario = Usuario::where('uuid', $uuid)->first();

        if (!$usuario) {
            return response(status: 404);
        }

        if (!$usuario->delete()) {
            return response(status: 400);
        }

        return response(status: 200);
    }
}

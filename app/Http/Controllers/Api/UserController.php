<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Listar Usuarios
     */
    public function index(): JsonResponse
    {
        $users = User::get();

        return response()->json([
            'status' => true,
            'users' => $users
        ], 200);
    }

    /**
     * Visualizar Usuario
     */
    public function show(User $user): JsonResponse
    {
         // Verifica se o usuário existe
         if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Usuário não encontrado',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'user' => $user
        ], 200);
    }

    /**
     * Inserir Usuario
     */
    public function store(UserRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $user =  User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => $request->password,
            ]);

            DB::commit();

            return response()->json([
                'status'    => true,
                'message'   => "Usuário cadastrado com sucesso",
                'user'      => $user
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => "Usuário não cadastrado",
                'erro' => $e,
            ], 400);
        }
    }

    /**
     * Atualizar Usuário
     */
    public function update(UserRequest $request, User $user): JsonResponse
    {

        DB::beginTransaction();
        try {
            $user->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => $request->password,
            ]);

            DB::commit();

            return response()->json([
                'status'    => true,
                'message'   => "Usuário editado com sucesso",
                'user'      => $user
            ], 201);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => "Usuário não editado",
                'erro' => $e,
            ], 400);
        }

    }

    /**
     * Deletar Usuário
     */
    public function destroy($id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Usuário com o id ' .$id. ' não encontrado para apagar',
            ], 404);
        }

        try {
            $user->delete();
            return response()->json([
                'status'    => true,
                'message'   => "Usuário apagado com sucesso",
                'user'      => $user
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Usuário não apagado",
                'erro' => $e,
            ], 400);
        }
    }
}

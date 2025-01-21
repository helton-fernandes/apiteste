<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

           $user = Auth::user();
           $token = $request->user()->createToken('api-token')->plainTextToken;
            return response()->json([
                'status' => true,
                'user' => $user,
                'token' => $token
            ],201);

        }else{
            return response()->json([
                'status' => false,
                'message'=> 'O login ou a senha está incorreta'
            ], 404);
        }


        return response()->json([
            'status' => true,
            'token' => "123456controller"
        ]);
    }

    public function logout(User $user): JsonResponse
    {
        try {
            $user->tokens()->delete();
            return response()->json([
                'status' => true,
                'message' => "Logout efetuado com sucesso!",
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Usuário não deslogou",
                'erro' => $e,
            ], 400);
        }

        return response()->json([
            'status' => true,
            'message' => "Logout efetudado com sucesso!"
        ]);
    }
}

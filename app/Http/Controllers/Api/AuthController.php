<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;



class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Login user",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"username", "password"},
     *             @OA\Property(property="username", type="string", example="user@example.com"),
     *             @OA\Property(property="password", type="string", example="123456")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil login",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="Login berhasil"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="token", type="string", example="1|token...")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Gagal login",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="code", type="integer", example=401),
     *             @OA\Property(property="message", type="string", example="Username atau password salah"),
     *             @OA\Property(property="data", type="string", example=null)
     *         )
     *     )
     * )
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->username)
                    ->where('level', 3)
                    ->first();

       if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'code' => 401,
                'message' => 'Username atau password salah',
                'data' => null
            ], 401);
        }

        // Hapus semua token lama user ini
        $user->tokens()->delete();

        // Buat token baru
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Login berhasil',
            'data' => [
                'token' =>  $token
            ]
        ], 200);

    }

}

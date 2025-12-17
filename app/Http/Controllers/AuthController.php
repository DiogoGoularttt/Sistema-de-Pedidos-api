<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\RefreshToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'phone'    => $data['phone'],
            'role'     => 'client',
        ]);

        $user->sendEmailVerificationNotification();

        // Access Token
        $accessToken = $user->createToken('auth_token')->plainTextToken;

        // Refresh Token
        $refreshToken = Str::random(64);

        RefreshToken::create([
            'user_id'    => $user->id,
            'token'      => hash('sha256', $refreshToken),
            'expires_at' => now()->addDays(30),
        ]);

        return response()->json([
            'message' => 'Usuário criado com sucesso!',
            'data' => [
                'token'          => $accessToken,
                'refresh_token'  => $refreshToken,
                'user' => [
                    'id'    => $user->id,
                    'name'  => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'role'  => 'client',
                ],
            ],
        ], 201);
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
            'remember' => 'boolean',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        if (! $user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Verifique seu e-mail antes de fazer login.'
            ], 403);
        }

        // Access Token (5 minutos)
        $accessToken = $user->createToken(
            'auth_token',
            expiresAt: now()->addMinutes(5)
        )->plainTextToken;

        // Refresh Token
        $refreshToken = Str::random(64);

        $expiresAt = $request->boolean('remember')
            ? now()->addDays(7)
            : now()->addMinutes(30);

        RefreshToken::updateOrCreate(
            ['user_id' => $user->id],
            [
                'token' => hash('sha256', $refreshToken),
                'expires_at' => $expiresAt,
            ]
        );

        return response()->json([
            'data' => [
                'token' => $accessToken,
                'refresh_token' => $refreshToken,
                'user' => [
                    'id'    => $user->id,
                    'name'  => $user->name,
                    'email' => $user->email,
                    'role'  => $user->role->value,
                ],
            ],
        ]);
    }

    /**
     * Refresh Token
     */
    public function refresh(Request $request)
    {
        $request->validate([
            'refresh_token' => 'required|string'
        ]);

        $hashed = hash('sha256', $request->refresh_token);

        $refreshToken = RefreshToken::where('token', $hashed)
            ->where('expires_at', '>', now())
            ->first();

        if (! $refreshToken) {
            return response()->json(['message' => 'Refresh token inválido'], 401);
        }

        $user = $refreshToken->user;

        $newAccessToken = $user->createToken(
            'auth_token',
            expiresAt: now()->addMinutes(5)
        )->plainTextToken;

        return response()->json([
            'data' => [
                'token' => $newAccessToken
            ]
        ]);
    }


    /**
     * Logout
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout realizado com sucesso'
        ]);
    }
}

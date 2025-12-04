<?php

namespace App\Http\Middleware;

use App\Enums\UserTypeEnum;
use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Não autenticado'], 401);
        }

        // IMPORTANTE → Comparar com o ->value do enum
        if ($user->role->value !== $role) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        return $next($request);
    }
}

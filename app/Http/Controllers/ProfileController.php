<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    /**
     * Retorna dados do perfil do usuário autenticado
     */
    public function show(Request $request)
    {
        return response()->json(
            $request->user()->load([
                'userAddresses.streetAddress.neighborhood.city.state.country',
                'userAddresses.streetAddress.zipcode',
            ])
        );
    }

    /**
     * Atualiza nome, email e telefone
     */
    public function update(UpdateProfileRequest $request)
    {
        $user = $request->user();

        $emailChanged = $request->email !== $user->email;

        $user->fill($request->only(['name', 'email', 'phone']));

        if ($emailChanged) {
            $user->email_verified_at = null;
        }

        $user->save();

        if ($emailChanged) {
            $user->sendEmailVerificationNotification();
        }

        return response()->json([
            'message' => 'Perfil atualizado com sucesso',
            'user' => $user,
        ]);
    }
}

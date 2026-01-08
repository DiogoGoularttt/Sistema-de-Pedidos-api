<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAddress;
use App\Http\Requests\StoreUserAddressRequest;
use App\Http\Requests\UpdateUserAddressRequest;

class UserAddressController extends Controller
{
    public function store(StoreUserAddressRequest $request)
    {
        $address = UserAddress::create([
            'user_id' => $request->user()->id,
            'street_address_id' => $request->street_address_id,
            'number' => $request->number,
            'complement' => $request->complement,
            'reference' => $request->reference,
        ]);

        return response()->json([
            'message' => 'Endereço adicionado com sucesso',
            'address' => $address->load(
                'streetAddress.neighborhood.city.state.country',
                'streetAddress.zipcode'
            ),
        ], 201);
    }

    public function update(UpdateUserAddressRequest $request, UserAddress $userAddress)
    {
        abort_if($userAddress->user_id !== $request->user()->id, 403);

        $userAddress->update($request->validated());

        return response()->json([
            'message' => 'Endereço atualizado',
            'address' => $userAddress,
        ]);
    }

    public function destroy(Request $request, UserAddress $userAddress)
    {
        abort_if($userAddress->user_id !== $request->user()->id, 403);

        $userAddress->delete();

        return response()->json([
            'message' => 'Endereço removido com sucesso',
        ]);
    }
}

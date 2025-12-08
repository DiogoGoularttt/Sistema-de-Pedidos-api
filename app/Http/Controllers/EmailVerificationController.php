<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function verify(Request $request)
    {
        $user = \App\Models\User::findOrFail($request->id);

        if (! hash_equals((string) $request->hash, sha1($user->email))) {
            return view('email.verified')->with([
                'message' => 'Link de verificação inválido.'
            ]);
        }

        if ($user->hasVerifiedEmail()) {
            return view('email.verified')->with([
                'message' => 'E-mail já verificado anteriormente.'
            ]);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return view('email.verified')->with([
            'message' => 'E-mail verificado com sucesso!'
        ]);
    }


    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email already verified']);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'Verification link sent!']);
    }
}

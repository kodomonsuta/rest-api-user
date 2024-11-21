<?php

namespace App\Actions\Api\User\Login;

class AuthenticationUser
{
    public static function handle(\Illuminate\Http\Request $request)
    {
        $user = \App\Models\User::where('email', $request->email)->first();

        if (! \Hash::check($request->password, $user->password)) {
            throw new \Exception('Invalid password', 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        $request->merge([
            'user' => $user,
            'user_token' => $token,
        ]);
    }
}

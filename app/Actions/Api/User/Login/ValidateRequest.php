<?php

namespace App\Actions\Api\User\Login;

class ValidateRequest
{
    public static function handle(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);
    }
}

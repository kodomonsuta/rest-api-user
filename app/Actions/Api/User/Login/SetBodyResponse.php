<?php

namespace App\Actions\Api\User\Login;

class SetBodyResponse
{
    public static function handle(\Illuminate\Http\Request $request)
    {
        $user = $request->user;
        $request->merge([
            'body_response' => [
                'user_name' => $user->name,
                'user_email' => $user->email,
                'user_token' => $request->user_token,
            ],
        ]);
    }
}

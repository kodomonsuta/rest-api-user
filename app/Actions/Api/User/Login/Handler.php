<?php

namespace App\Actions\Api\User\Login;

use App\Exceptions\ApiException;

class Handler
{
    public function handle(\Illuminate\Http\Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            ValidateRequest::handle($request);
            AuthenticationUser::handle($request);
            SetBodyResponse::handle($request);
            return response()->api(200, 'success', $request->body_response, 'Client saved successfully');
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage(), $e->getCode(), $e);
        }
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->macroApiResponse();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Macro api response
     */
    private function macroApiResponse(): void
    {
        Response::macro('api', function ($httpCode = 200, $status = 'success', $data = [], $message = '', $action = '') {
            return response()->json([
                'code' => $httpCode,
                'status' => $status,
                'data' => $data,
                'message' => $message,
                'action' => $action,
            ], $httpCode);
        });
    }
}

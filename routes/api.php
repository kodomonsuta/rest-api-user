<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => []], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::post('login', function (Request $request) {
            return app('app.action.api.user.login')->handle($request);
        })->name('login');
    });
});

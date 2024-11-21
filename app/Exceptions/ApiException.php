<?php

namespace App\Exceptions;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Throwable;

class ApiException extends Exception
{
    public function __construct(string $message = 'Something went wrong', int $code = 500)
    {
        parent::__construct($message, $code);
    }

    public function render($request)
    {
        $detailError = [];

        if ($this instanceof ValidationException == true) {
            $detailError = self::validationException($this);
        } elseif ($this instanceof QueryException == true) {
            $detailError = self::queryException($this);
        } elseif ($this instanceof ClientException == true) {
            $detailError = self::clientException($this);
        } else {
            $detailError = self::elseException($this);
        }

        return response()->api(
            $detailError['code'],
            'failed',
            [],
            $detailError['message'],
            $detailError['action']
        );
    }

    public static function validationException(Throwable $e): array
    {
        $errors = $e->errors();
        if (empty($errors)) {
            $message = 'an unexpected error occurred';
        } else {
            foreach ($errors as $key => $value) {
                $message = $value[0];
            }
        }
        $code = 400;
        $action = '';

        return compact('code', 'message', 'action');
    }

    public static function queryException(Throwable $e): array
    {
        $message = (config('app.env') == 'production') ? 'Query failed to execute' : $e->getMessage();
        $code = 400;
        $action = '';

        return compact('code', 'message', 'action');
    }

    public static function clientException(Throwable $e): array
    {
        $message = (config('app.env') == 'production') ? 'Failed fetching http request' : $e->getMessage();
        $code = $exceptionCode;
        $action = '';

        return compact('code', 'message', 'action');
    }

    public static function elseException(Throwable $e): array
    {
        $message = (config('app.env') == 'production') ? 'Something wrong happen' : $e->getMessage();
        $code = (config('app.env') == 'production') ? 500 : $e->getCode();
        $action = '';

        return compact('code', 'message', 'action');
    }
}

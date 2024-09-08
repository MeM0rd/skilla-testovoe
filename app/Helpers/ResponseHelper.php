<?php

namespace App\Helpers;

class ResponseHelper
{
    public static function makeResponseArray(int $statusCode, array $data, string $message = null) : array
    {
        return [
            'status' => $statusCode,
            'message' => $message,
            'data' => $data,
        ];
    }
}

<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function apiResponse($statusCode, $message, $error_code, $data = null)
{
    return response()->json([
        'status' => $statusCode,
        'msg' => $message,
        'error_code' => $error_code,
        'data' => $data,
    ]);
}
}

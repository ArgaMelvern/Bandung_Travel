<?php
namespace App\Http\Library;

use Illuminate\Http\JsonResponse;

trait ApiHelpers{
    private $headers = [
        'Content-Type' => 'application/json'
    ];

    protected function onUnauthorized(): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized'
        ], 401, $this->headers);
    }

    protected function onSuccess($data, $message, int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code, $this->headers);
    }

    protected function onError($message, $errormsg, int $code = 404): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errormsg' => $errormsg,
            'data' => '',
        ], $code, $this->headers);
    }

    protected function FunctionName(Type $var = null)
    {
        # code...
    }
}
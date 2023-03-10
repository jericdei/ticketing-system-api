<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendResponse(string $message, int $status = 200): JsonResponse
    {
        return response()->json([
            'message' => $message
        ], $status);
    }

    public function sendResponseWithData(string $message, mixed $data): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ]);
    }
}

<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    /**
     * Generate a standardized JSON response.
     *
     * @param mixed $data
     * @param int $status
     * @param string|null $message
     * @return JsonResponse
     */
    public static function jsonResponse($data = null, $status = 200, $message = null): JsonResponse
    {
        return response()->json([
            'success' => $status < 400,  // Indicates success or failure based on the status code
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}

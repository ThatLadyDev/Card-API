<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class APIException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $this->getMessage(),
            'errors' => [
                'file' => $this->getFile(),
                'line' => $this->getLine(),
                'trace' => $this->getTrace(),
            ],
            'data' => [],
        ], 500);
    }
}

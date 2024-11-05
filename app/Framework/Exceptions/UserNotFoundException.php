<?php

namespace App\Framework\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class UserNotFoundException extends Exception
{
    protected $message = 'User not found';

    public function render($request): JsonResponse
    {
        return response()->json([
            'error' => $this->getMessage(),
        ], 404);
    }
}

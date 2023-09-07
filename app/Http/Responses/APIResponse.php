<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class APIResponse
{
    private string $message;

    /** @var array $data */
    private array $data;

    private int $status;

    /**
     * @param string $message
     * @param array $data
     * @param int $status
     */
    public function __construct(string $message = '', array $data = [], int $status = 200)
    {
        $this->message = $message;
        $this->data = $data;
        $this->status = $status;
    }

    public function setMessage(string $message): APIResponse
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): APIResponse
    {
        $this->data = $data;
        return $this;
    }

    public function setStatus(int $status): APIResponse
    {
        $this->status = $status;
        return $this;
    }

    public function success(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $this->message,
            'errors' => [],
            'data' => $this->data,
        ], $this->status);
    }

    public function error(): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $this->message,
            'errors' => [],
            'data' => $this->data,
        ], $this->status);
    }
}

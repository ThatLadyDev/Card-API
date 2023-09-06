<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class APIResponse
{
    /** @var string $message */
    private string $message;

    /** @var array $data */
    private array $data;

    /** @var int $status */
    private int $status;

    /**
     * @param string $message
     * @param array $data
     * @param int $status
     */
    public function __construct(string $message = '', array $data = [], $status = 200)
    {
        $this->message = $message;
        $this->data = $data;
        $this->status = $status;
    }

    /**
     * @param string $message
     * @return APIResponse
     */
    public function setMessage(string $message): APIResponse
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param array $data
     * @return APIResponse
     */
    public function setData(array $data): APIResponse
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param int $status
     * @return APIResponse
     */
    public function setStatus(int $status): APIResponse
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return JsonResponse
     */
    public function success(): JsonResponse
    {
        return response()->json([
           'success' => true,
            'message' => $this->message,
            'errors' => [],
            'data' => $this->data
        ], $this->status);
    }

    public function error(): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $this->message,
            'errors' => [],
            'data' => $this->data
        ], $this->status);
    }
}

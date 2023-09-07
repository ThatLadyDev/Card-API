<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\GetMerchantFinishedTasksRequest;
use App\Http\Responses\APIResponse;
use App\Http\Services\TaskService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private TaskService $taskService;

    private APIResponse $response;

    public function __construct()
    {
        $this->taskService = new TaskService();
        $this->response = new APIResponse();
    }

    public function finishedTasksByMerchant(GetMerchantFinishedTasksRequest $request): JsonResponse
    {
        $tasks = $this->taskService->listByUser($request->route('uuid'));
        return $this->response->setData($tasks)->success();
    }
}

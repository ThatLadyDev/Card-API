<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\GetMerchantFinishedTasksRequest;
use App\Http\Responses\APIResponse;
use App\Http\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /** @var TaskService $taskService */
    private TaskService $taskService;

    /** @var APIResponse $response */
    private APIResponse $response;

    public function __construct()
    {
        $this->taskService = new TaskService();
        $this->response = new APIResponse();
    }

    /**
     * @param string $uuid
     * @param GetMerchantFinishedTasksRequest $request
     * @return JsonResponse
     */
    public function finishedTasksByMerchant(string $uuid, GetMerchantFinishedTasksRequest $request): JsonResponse
    {
        $tasks = $this->taskService->listByUser($uuid);
        return $this->response->setData($tasks)->success();
    }
}

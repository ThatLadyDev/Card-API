<?php

namespace App\Http\Controllers\API;

use App\Enums\TaskType;
use App\Exceptions\APIException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Responses\APIResponse;
use App\Http\Services\CardService;
use App\Http\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /** @var TaskService $service */
    private TaskService $service;

    /** @var APIResponse $response */
    private APIResponse $response;

    public function __construct()
    {
        $this->service = new TaskService();
        $this->response = new APIResponse();
    }

    /**
     * @param CreateRequest $request
     * @return JsonResponse
     * @throws APIException
     */
    public function create(CreateRequest $request): JsonResponse
    {
        $this->service->create($request);
        return $this->response->setMessage('Task Created Successfully.')->success();
    }

    /**
     * @param string $uuid
     * @param UpdateRequest $request
     * @return JsonResponse
     * @throws APIException
     */
    public function update(string $uuid, UpdateRequest $request): JsonResponse
    {
        $task = $this->service->mark($uuid);
        $request->action === 'mark_as_finished' ? $task->asFinished() : $task->asFailed();
        return $this->response->setMessage('Task Updated Successfully.')->success();
    }
}

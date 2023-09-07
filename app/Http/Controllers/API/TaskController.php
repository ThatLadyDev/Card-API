<?php

namespace App\Http\Controllers\API;

use App\Exceptions\APIException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Responses\APIResponse;
use App\Http\Services\TaskService;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    private TaskService $service;

    private APIResponse $response;

    public function __construct()
    {
        $this->service = new TaskService();
        $this->response = new APIResponse();
    }

    /**
     * @throws APIException
     */
    public function create(CreateRequest $request): JsonResponse
    {
        $this->service->create($request);
        return $this->response->setMessage('Task Created Successfully.')->success();
    }

    /**
     * @throws APIException
     */
    public function update(UpdateRequest $request): JsonResponse
    {
        $task = $this->service->mark($request->route('uuid'));
        $request->getAction() === 'mark_as_finished' ? $task->asFinished() : $task->asFailed();
        return $this->response->setMessage('Task Updated Successfully.')->success();
    }
}

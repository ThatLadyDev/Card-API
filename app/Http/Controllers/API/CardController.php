<?php

namespace App\Http\Controllers\API;

use App\Exceptions\APIException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Card\CreateRequest;
use App\Http\Requests\Card\GetRequest;
use App\Http\Responses\APIResponse;
use App\Http\Services\CardService;
use Illuminate\Http\JsonResponse;

class CardController extends Controller
{
    /** @var CardService $service */
    private CardService $service;

    /** @var APIResponse $response */
    private APIResponse $response;

    public function __construct()
    {
        $this->service = new CardService();
        $this->response = new APIResponse();
    }

    /**
     * @param string $uuid
     * @param GetRequest $request
     * @return JsonResponse
     */
    public function single(string $uuid, GetRequest $request): JsonResponse
    {
        $card = $this->service->get($uuid);
        return $this->response->setData($card)->success();
    }

    /**
     * @param CreateRequest $request
     * @return JsonResponse
     * @throws APIException
     */
    public function create(CreateRequest $request): JsonResponse
    {
        $this->service->create($request);
        return $this->response->setMessage('Card Created Successfully.')->success();
    }
}

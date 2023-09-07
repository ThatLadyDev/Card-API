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
    private CardService $service;

    private APIResponse $response;

    public function __construct()
    {
        $this->service = new CardService();
        $this->response = new APIResponse();
    }

    public function single(GetRequest $request): JsonResponse
    {
        $card = $this->service->get($request->route('uuid'));
        return $this->response->setData($card)->success();
    }

    /**
     * @throws APIException
     */
    public function create(CreateRequest $request): JsonResponse
    {
        $this->service->create($request);
        return $this->response->setMessage('Card Created Successfully.')->success();
    }
}

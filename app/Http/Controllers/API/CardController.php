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

    /**
     * @OA\Get(
     *     path="/api/card/{uuid}",
     *     summary="Get a card",
     *     operationId="single_card",
     *     description="Returns information of a created card by its card UUID",
     *     @OA\Parameter(
     *         name="UUID",
     *         description="Valid Card UUID",
     *         in="path",
     *         required=true,
     *         example="f77d6287-a955-4f30-a581-28421b7fe9e9"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Single card",
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Something went wrong",
     *     )
     * )
     */
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

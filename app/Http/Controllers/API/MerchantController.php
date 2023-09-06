<?php

namespace App\Http\Controllers\API;

use App\Exceptions\APIException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Merchant\CreateRequest;
use App\Http\Requests\Merchant\GetRequest;
use App\Http\Responses\APIResponse;
use App\Http\Services\MerchantService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    /** @var MerchantService $service */
    private MerchantService $service;

    /** @var APIResponse $response */
    private APIResponse $response;

    public function __construct()
    {
        $this->service = new MerchantService();
        $this->response = new APIResponse();
    }

    /**
     * @param string $uuid
     * @param GetRequest $request
     * @return JsonResponse
     */
    public function single(string $uuid, GetRequest $request): JsonResponse
    {
        $merchant = $this->service->get($uuid);
        return $this->response->setData($merchant)->success();
    }

    /**
     * @param CreateRequest $request
     * @return JsonResponse
     * @throws APIException
     */
    public function create(CreateRequest $request): JsonResponse
    {
        $this->service->create($request);
        return $this->response->setMessage('Merchant Created Successfully.')->success();
    }
}

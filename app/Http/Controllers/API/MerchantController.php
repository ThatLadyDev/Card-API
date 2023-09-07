<?php

namespace App\Http\Controllers\API;

use App\Exceptions\APIException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Merchant\CreateRequest;
use App\Http\Requests\Merchant\GetRequest;
use App\Http\Responses\APIResponse;
use App\Http\Services\MerchantService;
use Illuminate\Http\JsonResponse;

class MerchantController extends Controller
{
    private MerchantService $service;

    private APIResponse $response;

    public function __construct()
    {
        $this->service = new MerchantService();
        $this->response = new APIResponse();
    }

    public function single(GetRequest $request): JsonResponse
    {
        $merchant = $this->service->get($request->route('uuid'));
        return $this->response->setData($merchant)->success();
    }

    /**
     * @throws APIException
     */
    public function create(CreateRequest $request): JsonResponse
    {
        $this->service->create($request);
        return $this->response->setMessage('Merchant Created Successfully.')->success();
    }
}

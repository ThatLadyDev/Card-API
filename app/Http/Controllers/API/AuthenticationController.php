<?php

namespace App\Http\Controllers\API;

use App\Exceptions\APIException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Responses\APIResponse;
use App\Http\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;

class AuthenticationController extends Controller
{
    /** @var UserService $service */
    private UserService $service;

    /** @var APIResponse $response */
    private APIResponse $response;

    public function __construct()
    {
        $this->service = new UserService();
        $this->response = new APIResponse();
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $this->service->create($request);
        $this->response->setMessage('Account Created Successfully.');
        return $this->response->success();
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws APIException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $token = $this->service->login($request);

        if ($token === false) {
            return $this->response
                ->setMessage('Invalid Credentials Provided.')
                ->setStatus(401)
                ->error();
        }

        return $this->response
            ->setMessage('Account Logged In Successfully.')
            ->setData(['token' => $token])
            ->success();
    }
}

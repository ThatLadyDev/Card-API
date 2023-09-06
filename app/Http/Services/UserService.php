<?php

namespace App\Http\Services;

use App\Exceptions\APIException;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserService
{
    /**
     * @param RegisterRequest $request
     * @return void
     * @throws Exception
     */
    public function create(RegisterRequest $request): void
    {
        try {
            User::query()->create([
                'uuid' => Str::uuid(),
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'is_super_admin' => $request->isAdmin
            ]);
        }
        catch (Exception $e){
            throw new APIException($e->getMessage());
        }
    }

    /**
     * @throws APIException
     */
    public function login(LoginRequest $request): bool|string
    {
        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                /** @var User $user */
                $user = Auth::user();
                return $user->createToken(config('app.name'))->accessToken;
            }

            return false;
        }
        catch (Exception $e){
            throw new APIException($e->getMessage());
        }
    }
}

<?php

namespace App\Http\Services;

use App\Exceptions\APIException;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserService
{
    /**
     * @throws Exception
     */
    public function create(RegisterRequest $request): void
    {
        try {
            User::query()->create([
                'uuid' => Str::uuid(),
                'name' => $request->getName(),
                'email' => $request->getEmail(),
                'password' => bcrypt($request->getUserPassword()),
                'is_super_admin' => $request->getIsAdmin(),
            ]);
        } catch (Exception $e) {
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
        } catch (Exception $e) {
            throw new APIException($e->getMessage());
        }
    }

    /**
     * @param array $get
     *
     * @return array
     */
    public function get(string $uuid, array $get = ['*']): array
    {
        return User::whereUuid($uuid)->first($get)->toArray();
    }
}

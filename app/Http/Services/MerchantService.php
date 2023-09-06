<?php

namespace App\Http\Services;

use App\Exceptions\APIException;
use App\Http\Requests\Merchant\CreateRequest;
use App\Models\Merchant;
use Exception;
use Illuminate\Support\Str;

class MerchantService
{
    /**
     * @param CreateRequest $request
     * @return void
     * @throws APIException
     */
    public function create(CreateRequest $request): void
    {
        try {
            Merchant::query()->create([
                'uuid' => Str::uuid(),
                'name' => $request->name,
                'website' => $request->website,
            ]);
        }
        catch (Exception $e){
            throw new APIException($e->getMessage());
        }
    }

    /**
     * @param string $uuid
     * @param array $get
     * @return array
     */
    public function get(string $uuid, array $get = ['*']): array
    {
        return Merchant::whereUuid($uuid)->first($get)->toArray();
    }
}

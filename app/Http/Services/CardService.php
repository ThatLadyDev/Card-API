<?php

namespace App\Http\Services;

use App\Exceptions\APIException;
use App\Http\Requests\Card\CreateRequest;
use App\Models\Card;
use Exception;
use Illuminate\Support\Str;

class CardService
{
    /**
     * @throws APIException
     */
    public function create(CreateRequest $request): void
    {
        try {
            Card::query()->create([
                'uuid' => Str::uuid(),
                'user_id' => auth()->id(),
                'card_number' => $request->getCardNumber(),
                'expiration_date' => $request->getExpirationDate(),
                'cvv' => $request->getCvv(),
                'cardholder_name' => $request->getCardholderName(),
            ]);
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
        return Card::whereUuid($uuid)->first($get)->toArray();
    }
}

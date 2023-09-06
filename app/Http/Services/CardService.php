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
     * @param CreateRequest $request
     * @return void
     * @throws APIException
     */
    public function create(CreateRequest $request): void
    {
        try {
            Card::query()->create([
               'uuid' => Str::uuid(),
               'user_id' => auth()->id(),
               'card_number' => $request->cardNumber,
               'expiration_date' => $request->expirationDate,
               'cvv' => $request->cvv,
               'cardholder_name' => $request->cardholderName,
            ]);
        }
        catch (Exception $e){
            throw new APIException($e->getMessage());
        }
    }

    /**
     * @param string $uuid
     * @return array
     */
    public function get(string $uuid): array
    {
        return Card::whereUuid($uuid)->first()->toArray();
    }
}

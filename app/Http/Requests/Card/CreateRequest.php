<?php

namespace App\Http\Requests\Card;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    private string $cardNumber;

    private string $expirationDate;

    private int $cvv;

    private string $cardholderName;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'card_number' => 'required|unique:cards,card_number',
            'expiration_date' => 'required|date_format:m/Y|after:today',
            'cvv' => 'required|numeric|digits:3',
            'cardholder_name' => 'required|string|max:255',
        ];
    }

    public function getCardholderName(): string
    {
        return $this->cardholderName;
    }

    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    public function getExpirationDate(): string
    {
        return $this->expirationDate;
    }

    public function getCvv(): int
    {
        return $this->cvv;
    }

    protected function passedValidation(): void
    {
        $this->cardNumber = $this->input('card_number');
        $this->expirationDate = Carbon::createFromFormat('m/Y', $this->input('expiration_date'))->format('Y-m-d');
        $this->cvv = $this->input('cvv');
        $this->cardholderName = $this->input('cardholder_name');
    }
}

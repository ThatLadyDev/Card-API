<?php

namespace App\Http\Requests\Task;

use App\Enums\TaskType;
use App\Rules\CheckCardsForUser;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    private string $newCardUuid;

    private string $merchantUuid;

    private string $type;

    private string $previousCardUuid;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function getNewCardUuid(): string
    {
        return $this->newCardUuid;
    }

    public function getMerchantUuid(): string
    {
        return $this->merchantUuid;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPreviousCardUuid(): string
    {
        return $this->previousCardUuid;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'new_card_uuid' => [
                'required',
                'uuid',
                'exists:cards,uuid',
                new CheckCardsForUser(),
                'different:prev_card_uuid',
            ],
            'prev_card_uuid' => 'required|uuid|exists:cards,uuid',
            'merchant_uuid' => 'required|string|exists:merchants,uuid',
            'type' => [
                'required',
                'string',
                'in:' . implode(',', TaskType::toArray('name')),
            ],
        ];
    }

    protected function passedValidation(): void
    {
        $this->newCardUuid = $this->input('new_card_uuid');
        $this->previousCardUuid = $this->input('prev_card_uuid');
        $this->merchantUuid = $this->input('merchant_uuid');
        $this->type = $this->input('type');
    }
}

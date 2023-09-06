<?php

namespace App\Http\Requests\Task;

use App\Enums\TaskType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /** @var string $cardUuid */
    public string $cardUuid;

    /** @var string $merchantUuid */
    public string $merchantUuid;

    /** @var string $type */
    public string $type;

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
            'card_uuid' => 'required|uuid|exists:cards,uuid',
            'merchant_uuid' => 'required|string|exists:merchants,uuid',
            'type' => [
                'required',
                'string',
                'in:' . implode(',', TaskType::toArray('name'))
            ]
        ];
    }

    protected function passedValidation(): void
    {
        $this->cardUuid = $this->input('card_uuid');
        $this->merchantUuid = $this->input('merchant_uuid');
        $this->type = $this->input('card_uuid');
    }
}

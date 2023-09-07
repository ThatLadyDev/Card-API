<?php

namespace App\Http\Requests\Merchant;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class GetRequest extends FormRequest
{
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
            'uuid' => 'required|string|exists:cards,uuid',
        ];
    }

    public function validationData(): array
    {
        return array_merge(parent::validationData(), ['uuid' => $this->route('uuid')]);
    }
}

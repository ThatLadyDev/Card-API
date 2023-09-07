<?php

namespace App\Http\Requests\Merchant;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    private string $name;

    private string $website;

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
            'name' => 'required|string',
            'website' => 'required|string',
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getWebsite(): string
    {
        return $this->website;
    }

    protected function passedValidation(): void
    {
        $this->name = $this->input('name');
        $this->website = $this->input('website');
    }
}

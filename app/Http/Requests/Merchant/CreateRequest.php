<?php

namespace App\Http\Requests\Merchant;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use function Symfony\Component\Translation\t;

class CreateRequest extends FormRequest
{
    /** @var string $name */
    public string $name;

    /** @var string $website */
    public string $website;

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

    protected function passedValidation(): void
    {
        $this->name = $this->input('name');
        $this->website = $this->input('website');
    }
}

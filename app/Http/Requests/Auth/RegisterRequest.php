<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /** @var string $name */
    public string $name;

    /** @var string $email */
    public string $email;

    /** @var string $password */
    public string $password;

    /** @var bool $isAdmin */
    public bool $isAdmin;

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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            'is_admin' => 'nullable|boolean'
        ];
    }

    /**
     * @return void
     */
    protected function passedValidation(): void
    {
        $this->name = $this->input('name');
        $this->email = $this->input('email');
        $this->password = $this->input('password');
        $this->isAdmin = $this->input('is_admin') === null ? false : $this->input('is_admin');
    }
}

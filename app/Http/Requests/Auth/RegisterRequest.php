<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    private string $name;

    private string $email;

    private string $userPassword;

    private bool $isAdmin;

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
            'is_admin' => 'nullable|boolean',
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUserPassword(): string
    {
        return $this->userPassword;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getIsAdmin(): bool
    {
        return $this->isAdmin;
    }

    protected function passedValidation(): void
    {
        $this->name = $this->input('name');
        $this->email = $this->input('email');
        $this->userPassword = $this->input('password');
        $this->isAdmin = $this->input('is_admin') === null ? false : $this->input('is_admin');
    }
}

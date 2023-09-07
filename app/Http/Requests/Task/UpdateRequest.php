<?php

namespace App\Http\Requests\Task;

use App\Enums\TaskAction;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    private string $action;

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
            'uuid' => 'required|string|exists:tasks,uuid',
            'action' => [
                'required',
                'string',
                'in:' . implode(',', TaskAction::toArray('name')),
            ],
        ];
    }

    public function validationData(): array
    {
        return array_merge(parent::validationData(), ['uuid' => $this->route('uuid')]);
    }

    public function getAction(): string
    {
        return $this->action;
    }

    protected function passedValidation(): void
    {
        $this->action = $this->input('action');
    }
}

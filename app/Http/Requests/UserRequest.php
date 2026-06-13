<?php

namespace App\Http\Requests;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    use PasswordValidationRules, ProfileValidationRules;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Adjust based on your authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $userId = $this->route('user') ? $this->route('user')->getKey() : null;
        $isUpdate = $userId !== null;

        return [
            'name' => $this->nameRules(),
            'email' => $this->emailRules($userId),
            'password' => $isUpdate
                ? ['nullable', 'string', 'min:8', 'confirmed']
                : $this->passwordRules(),
        ];
    }
}
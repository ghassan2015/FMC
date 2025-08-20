<?php

namespace App\Http\Requests\Admin\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
      return [
            'current_password' => 'required',
            'new_password' => 'required|string|min:8', // The 'confirmed' rule requires a matching field named 'new_password_confirmation'
            'confirm_new_password' => 'required|string|same:new_password', // Ensures it matches the new password

        ];
    }
}

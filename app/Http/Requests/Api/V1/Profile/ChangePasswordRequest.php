<?php

namespace App\Http\Requests\Api\V1\Profile;

use App\Http\Requests\BaseApiRequest;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends BaseApiRequest
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
            'current_password' => ['required', function ($attribute, $value, $fail) {
                // Check if the current password matches the authenticated user's password
                if (!Hash::check($value, auth()->user()->password)) {
                    $fail(__('The current password is incorrect.'));
                }
            }],
            'new_password' => 'required|min:6|confirmed',
        ];
    }
}

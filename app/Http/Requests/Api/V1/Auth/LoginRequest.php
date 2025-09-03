<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Requests\BaseApiRequest;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends BaseApiRequest
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
            'email' => 'required|email',
            'password' => 'required|min:8',
            'fcm_token'=>'required',
        ];
    }

    /**
     * Configure the validator instance.
     */
   protected function withValidator($validator): void
{
    $validator->after(function ($validator) {
        $user = User::where('email', $this->email)->first();

        if (!$user) {
            $validator->errors()->add('email', 'This email does not exist.');
            return;
        }

        if (!Hash::check($this->password, $user->password)) {
            $validator->errors()->add('password', 'Invalid password.');
        }
    });
}
}


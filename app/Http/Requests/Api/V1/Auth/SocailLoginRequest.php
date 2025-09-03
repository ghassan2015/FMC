<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Requests\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class SocailLoginRequest extends BaseApiRequest
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
                 'name' => 'required|string',
            'provider_id' => 'required',
            'provider_name' => 'required',
            'fcm_token' => 'required',
            'email'=>'required|email'
        ];
    }
}

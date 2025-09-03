<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Requests\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends BaseApiRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|unique:users,mobile',
            'birth_date' => 'required',
            'id_number' => 'required|unique:users,id_number',
            'password' => 'required|min:8',
            'fcm_token' => 'required',
            'gender_cd_id'=>'required|exists:constants,id'

        ];
    }
}

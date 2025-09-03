<?php

namespace App\Http\Requests\Api\V1\Profile;

use App\Http\Requests\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class updateProfileRequest extends BaseApiRequest
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
            'name' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'file', 'image', 'max:2048'], // Optional avatar field, only accepts images up to 2MB
            'email' => 'required|email|unique:users,email,' . auth('sanctum')->id(),
            'id_number' => 'required|unique:users,id_number,' . auth('sanctum')->id(),
            'mobile' => 'required|unique:users,mobile,' . auth('sanctum')->id(),
            'birth_date' => 'required',


        ];
    }
}

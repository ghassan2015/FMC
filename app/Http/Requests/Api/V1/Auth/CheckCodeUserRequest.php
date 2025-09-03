<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Requests\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class CheckCodeUserRequest extends BaseApiRequest
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
            'email'=>'required|exists:users,email',
            'code'=>'required',
        ];
    }

    protected function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $user = User::where('email', $this->email)->first();

            if (($user) && ($user->code !=$this->code)) {
                $validator->errors()->add('code', 'Your Code Invaild.');
            }
        });
    }
}

<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
    public function rules()
{
    $userId = $this->user_id; // أو $this->user_id حسب طريقة تمرير الـ ID

    return [
        'name' => 'required|string|max:255',
        'id_number' => 'required|unique:users,id_number,' . $userId,
        'email' => 'required|email|unique:users,email,' . $userId,
        'mobile' => 'required|string|max:20',
        'photo' => 'nullable|mimes:jpg,jpeg,png|max:2048', // تأكد من نوع الملف والحجم
    ];
}
}

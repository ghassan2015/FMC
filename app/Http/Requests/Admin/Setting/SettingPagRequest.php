<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingPagRequest extends FormRequest
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
            'about_us_ar' => 'required',
            'about_us_en' => 'required',
            'term_condition_ar' => 'required',
            'term_condition_en' => 'required',
            'privacy_policy_ar' => 'required',
            'privacy_policy_en' => 'required',

        ];
    }
}

<?php

namespace App\Http\Requests\Admin\Banners;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'title_ar' => 'required|string|max:100',
            'title_en' => 'required|string|max:100',
            'description_ar' => 'nullable|string|max:1000',
            'description_en' => 'nullable|string|max:1000',

            'is_active' => 'nullable',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|required_if:banners,null',

        ];
    }
}

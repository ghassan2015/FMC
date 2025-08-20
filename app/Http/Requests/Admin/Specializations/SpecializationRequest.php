<?php

namespace App\Http\Requests\Admin\Specializations;

use Illuminate\Foundation\Http\FormRequest;

class SpecializationRequest extends FormRequest
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
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string|max:1000',
            'description_en' => 'nullable|string|max:1000',
            'is_active' => 'nullable',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|required_if:specialization_id,null',
            'specialization_id' => 'nullable|exists:specializations,id',

        ];
    }
}

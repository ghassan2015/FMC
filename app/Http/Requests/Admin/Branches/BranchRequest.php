<?php

namespace App\Http\Requests\Admin\Branches;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
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
            'name_ar' => 'required',
            'name_en' => 'required',
            'address_ar' => 'required',
            'address_en' => 'required',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|required_if:branch_id,null',
            'branch_id' => 'nullable|exists:branches,id',
        ];
    }
}

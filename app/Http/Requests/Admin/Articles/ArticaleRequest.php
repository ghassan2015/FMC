<?php

namespace App\Http\Requests\Admin\Articles;

use Illuminate\Foundation\Http\FormRequest;

class ArticaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

  protected function prepareForValidation()
{
    $this->merge([
        'title_ar' => $this->title_ar ? trim($this->title_ar) : null,
        'title_en' => $this->title_en ? trim($this->title_en) : null,
        'description_ar' => $this->description_ar ? trim(strip_tags($this->description_ar)) : null,
        'description_en' => $this->description_en ? trim(strip_tags($this->description_en)) : null,

    ]);
}

    public function rules(): array
    {
        return [
       'title_ar' => 'required|string|max:100',
            'title_en' => 'required|string|max:100',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'specialization_id'=>'required|exists:specializations,id',

            'is_active' => 'nullable',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|required_if:articale_id,null',

        ];
    }
}

<?php

namespace App\Http\Requests\Admin\Videoes;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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
        $videoId = $this->video_id ?? null;

        return [
            'title_ar' => 'required|string|max:100',
            'title_en' => 'required|string|max:100',

            'description' => 'nullable|string',
            'url' => 'required|url|unique:videos,url,' . $videoId,
            'is_active' => 'nullable',
            'thumbnail' => $this->routeIs('admin.videos.store')
                ? 'required|image|mimes:jpg,jpeg,png,gif|max:2048'
                : 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }
}

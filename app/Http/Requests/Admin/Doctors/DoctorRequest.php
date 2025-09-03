<?php

namespace App\Http\Requests\Admin\Doctors;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }




    public function rules(): array
    {
        $doctorId = $this->doctor_id ?? null; // أو $this->doctor_id حسب طريقة التوجيه
        $adminId  = $this->admin_id ?? null;

        return [
            // 'medical_examination_price'=>'required|min:0|numeric',
            'name' => 'required|string|max:255',

            // license_number فريد في جدول doctors مع استثناء السجل الحالي
            'license_number' => [
                'required',
                Rule::unique('doctors', 'license_number')->ignore($doctorId),
            ],

            // email و mobile في جدول admins
            'email' => [
                'required',
                'email',
                Rule::unique('admins', 'email')->ignore($adminId),
            ],
            'mobile' => [
                'required',
                Rule::unique('admins', 'mobile')->ignore($adminId),
            ],

            'about_us_ar' => 'required|string',
            'about_us_en' => 'required|string',

            // password مطلوبة فقط عند الإنشاء
            'password' => 'nullable|required_if:doctor_id,null',

            // الصورة مطلوبة فقط عند الإنشاء
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|required_if:doctor_id,null',

            // الفروع والتخصص
            'branch_id' => 'required|array|min:1|exists:branches,id',
            'specialization_id' => 'required|exists:specializations,id',
        ];
    }


}



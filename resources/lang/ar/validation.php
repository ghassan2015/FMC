<?php

return [

    /*
    |--------------------------------------------------------------------------
    | خطوط التحقق
    |--------------------------------------------------------------------------
    */

    'accepted'             => 'يجب قبول حقل :attribute.',
    'active_url'           => 'حقل :attribute ليس رابطًا صحيحًا.',
    'after'                => 'يجب أن يكون حقل :attribute تاريخًا بعد :date.',
    'after_or_equal'       => 'يجب أن يكون حقل :attribute تاريخًا بعد أو يساوي :date.',
    'alpha'                => 'يجب أن يحتوي حقل :attribute على حروف فقط.',
    'alpha_dash'           => 'يجب أن يحتوي حقل :attribute على حروف وأرقام وشرطات فقط.',
    'alpha_num'            => 'يجب أن يحتوي حقل :attribute على حروف وأرقام فقط.',
    'array'                => 'يجب أن يكون حقل :attribute مصفوفة.',
    'before'               => 'يجب أن يكون حقل :attribute تاريخًا قبل :date.',
    'before_or_equal'      => 'يجب أن يكون حقل :attribute تاريخًا قبل أو يساوي :date.',
    'between'              => [
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'file'    => 'يجب أن يكون حجم الملف في حقل :attribute بين :min و :max كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف حقل :attribute بين :min و :max.',
        'array'   => 'يجب أن يحتوي حقل :attribute على عدد من العناصر بين :min و :max.',
    ],
    'boolean'              => 'يجب أن يكون حقل :attribute صحيحًا أو خاطئًا.',
    'confirmed'            => 'تأكيد حقل :attribute غير متطابق.',
    'date'                 => 'حقل :attribute ليس تاريخًا صحيحًا.',
    'date_equals'          => 'يجب أن يكون حقل :attribute تاريخًا يساوي :date.',
    'date_format'          => 'لا يتوافق حقل :attribute مع الصيغة :format.',
    'different'            => 'يجب أن يكون حقل :attribute و :other مختلفين.',
    'digits'               => 'يجب أن يحتوي حقل :attribute على :digits أرقام.',
    'digits_between'       => 'يجب أن يحتوي حقل :attribute على عدد أرقام بين :min و :max.',
    'dimensions'           => 'أبعاد الصورة في حقل :attribute غير صالحة.',
    'distinct'             => 'للحقل :attribute قيمة مكررة.',
    'email'                => 'يجب أن يكون حقل :attribute بريدًا إلكترونيًا صحيحًا.',
    'ends_with'            => 'يجب أن ينتهي حقل :attribute بأحد القيم التالية: :values.',
    'exists'               => 'القيمة المحددة في حقل :attribute غير صحيحة.',
    'file'                 => 'يجب أن يكون حقل :attribute ملفًا.',
    'filled'               => 'يجب أن يحتوي حقل :attribute على قيمة.',
    'gt'                   => [
        'numeric' => 'يجب أن تكون قيمة :attribute أكبر من :value.',
        'file'    => 'يجب أن يكون حجم الملف في حقل :attribute أكبر من :value كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف حقل :attribute أكبر من :value.',
        'array'   => 'يجب أن يحتوي حقل :attribute على أكثر من :value عناصر.',
    ],
    'gte'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute أكبر من أو تساوي :value.',
        'file'    => 'يجب أن يكون حجم الملف في حقل :attribute أكبر من أو يساوي :value كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف حقل :attribute أكبر من أو يساوي :value.',
        'array'   => 'يجب أن يحتوي حقل :attribute على :value عناصر أو أكثر.',
    ],
    'image'                => 'يجب أن يكون حقل :attribute صورة.',
    'in'                   => 'القيمة المحددة في حقل :attribute غير صحيحة.',
    'in_array'             => 'حقل :attribute غير موجود في :other.',
    'integer'              => 'يجب أن يكون حقل :attribute عددًا صحيحًا.',
    'ip'                   => 'يجب أن يكون حقل :attribute عنوان IP صالحًا.',
    'ipv4'                 => 'يجب أن يكون حقل :attribute عنوان IPv4 صالحًا.',
    'ipv6'                 => 'يجب أن يكون حقل :attribute عنوان IPv6 صالحًا.',
    'json'                 => 'يجب أن يكون حقل :attribute نص JSON صالحًا.',
    'lt'                   => [
        'numeric' => 'يجب أن تكون قيمة :attribute أصغر من :value.',
        'file'    => 'يجب أن يكون حجم الملف في حقل :attribute أصغر من :value كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف حقل :attribute أصغر من :value.',
        'array'   => 'يجب أن يحتوي حقل :attribute على أقل من :value عناصر.',
    ],
    'lte'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute أصغر من أو تساوي :value.',
        'file'    => 'يجب أن يكون حجم الملف في حقل :attribute أصغر من أو يساوي :value كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف حقل :attribute أصغر من أو يساوي :value.',
        'array'   => 'يجب أن لا يحتوي حقل :attribute على أكثر من :value عناصر.',
    ],
    'max'                  => [
        'numeric' => 'لا يجب أن تكون قيمة :attribute أكبر من :max.',
        'file'    => 'لا يجب أن يكون حجم الملف في حقل :attribute أكبر من :max كيلوبايت.',
        'string'  => 'لا يجب أن يكون عدد حروف حقل :attribute أكبر من :max.',
        'array'   => 'لا يجب أن يحتوي حقل :attribute على أكثر من :max عناصر.',
    ],
    'mimes'                => 'يجب أن يكون حقل :attribute ملفًا من النوع :values.',
    'mimetypes'            => 'يجب أن يكون حقل :attribute ملفًا من النوع :values.',
    'min'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute على الأقل :min.',
        'file'    => 'يجب أن يكون حجم الملف في حقل :attribute على الأقل :min كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف حقل :attribute على الأقل :min.',
        'array'   => 'يجب أن يحتوي حقل :attribute على الأقل على :min عناصر.',
    ],
    'not_in'               => 'القيمة المحددة في حقل :attribute غير صحيحة.',
    'not_regex'            => 'تنسيق حقل :attribute غير صالح.',
    'numeric'              => 'يجب أن يكون حقل :attribute رقمًا.',
    'password'             => 'كلمة المرور غير صحيحة.',
    'present'              => 'يجب تقديم حقل :attribute.',
    'regex'                => 'تنسيق حقل :attribute غير صالح.',
    'required'             => 'حقل :attribute مطلوب.',
    'required_if'          => 'حقل :attribute مطلوب عندما يكون :other يساوي :value.',
    'required_unless'      => 'حقل :attribute مطلوب إلا إذا كان :other ضمن :values.',
    'required_with'        => 'حقل :attribute مطلوب عندما يكون :values موجودًا.',
    'required_with_all'    => 'حقل :attribute مطلوب عندما تكون :values موجودة.',
    'required_without'     => 'حقل :attribute مطلوب عندما لا يكون :values موجودًا.',
    'required_without_all' => 'حقل :attribute مطلوب عندما لا تكون أي من :values موجودة.',
    'same'                 => 'يجب أن يتطابق حقل :attribute مع :other.',
    'size'                 => [
        'numeric' => 'يجب أن تكون قيمة :attribute هي :size.',
        'file'    => 'يجب أن يكون حجم الملف في حقل :attribute هو :size كيلوبايت.',
        'string'  => 'يجب أن يحتوي حقل :attribute على :size حروف.',
        'array'   => 'يجب أن يحتوي حقل :attribute على :size عناصر.',
    ],
    'starts_with'          => 'يجب أن يبدأ حقل :attribute بأحد القيم التالية: :values.',
    'string'               => 'يجب أن يكون حقل :attribute نصًا.',
    'timezone'             => 'يجب أن يكون حقل :attribute منطقة زمنية صحيحة.',
    'unique'               => 'قيمة حقل :attribute مستخدمة من قبل.',
    'uploaded'             => 'فشل في رفع حقل :attribute.',
    'url'                  => 'تنسيق حقل :attribute غير صالح.',
    'uuid'                 => 'يجب أن يكون حقل :attribute UUID صالحًا.',

    /*
    |--------------------------------------------------------------------------
    | تخصيص رسائل التحقق
    |--------------------------------------------------------------------------
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | أسماء الحقول للترجمة
    |--------------------------------------------------------------------------
    */

    'attributes' => [
        'name' => 'الاسم',
        'email' => 'البريد الإلكتروني',
        'password' => 'كلمة المرور',
        'mobile' => 'رقم الهاتف',
        'branch_id' => 'الفرع',
        'role_id' => 'الصلاحية',
        'redirect_route' => 'مسار إعادة التوجيه',
        'image' => 'الصورة',
    ],

];

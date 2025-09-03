<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class PirceUnitBaseRule implements Rule
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Retrieve the offer items from the request
        $item_units = json_decode($this->request->input('item_units'));

        // Check if each item's price_unit is not null, empty, or an empty string

        if ($this->request->item_type_cons_id != 12) {
            foreach ($item_units as $item) {
                if (empty($item->price_unit)) {
                    return false; // If any price_unit is empty or null, validation fails
                }
            }
        }

        return true; // All price_units are valid
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'يجب تحديد السعر للوحدة'; // Error message in Arabic
    }
}

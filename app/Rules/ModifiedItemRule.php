<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
class ModifiedItemRule implements  Rule
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
        $modified_item = json_decode($this->request->input('modified_item'));

        // Check if each item's price_unit is not null, empty, or an empty string
        foreach ($modified_item as $item) {


            if (empty($item->price)||empty($item->add_unit_id)||empty($item->delete_unit_id)||empty($item->add_quantity)||empty($item->delete_quantity)||empty($item->plus_price)||empty($item->minus_price)){
                return false; // If any price_unit is empty or null, validation fails
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
        return 'يجب اكمال جميع بيانات المعدلة'; // Error message in Arabic
    }

}

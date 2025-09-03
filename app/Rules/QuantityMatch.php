<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class QuantityMatch implements Rule
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
        $offerTypeId = $this->request->input('offer_type_cons_type_id');

        // Check if the offer type ID is 64 or 65
        if ($offerTypeId == 64 || $offerTypeId == 65) {
            $totalQuantity = 0;

            // Retrieve the offer items from the request
            $base_item = json_decode(request()->base_item);

            $mandatory_flag=false;
            foreach ($base_item as $item) {
                $quantity = (float) $item->quantity;
                $mandatory=$item->mandatory;

                if (!is_nan($quantity) && $mandatory) {
            $mandatory_flag=true;
                    $totalQuantity += $quantity;
                }
            }

//            dd($totalQuantity);
            // Check if the total quantity matches the input value
            if($mandatory_flag) {
                return $totalQuantity === (float)$value;
            }
        }

        // If offer type ID is not 64 or 65, skip this validation
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The total quantity does not match.';
    }

}

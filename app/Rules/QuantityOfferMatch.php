<?php

namespace App\Rules;

use Closure;
// use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class QuantityOfferMatch implements Rule
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
            $base_item = json_decode(request()->offer_item);

//            dd($base_item);
            foreach ($base_item as $item) {
                $mandatory=$item->mandatory;

                $quantity = (float) $item->quantity;
                if (!is_nan($quantity) && $mandatory) {
                    $totalQuantity += $quantity;
                }
//                dd($totalQuantity);

            }

            // Check if the total quantity matches the input value
            return $totalQuantity === (float) $value;
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

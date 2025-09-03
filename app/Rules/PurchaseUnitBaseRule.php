<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class PurchaseUnitBaseRule implements Rule
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
        $item_units = $this->request->input('item_units');




        // if($this->request->item_type_cons_id==12||$this->request->item_type_cons_id==13||$this->request->item_type_cons_id==14){

            // Retrieve the offer items from the request
            $item_units = json_decode(request()->item_units);

            // $purchase_unit=false;

            foreach ($item_units as $item) {

                if($item->purchase_unit){
                    return true;
                }

            }



        return false;
        // }

        // return true'
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'يجب ان يكون  وحدة شراء واحدة فعالة على الاقل';
    }
}

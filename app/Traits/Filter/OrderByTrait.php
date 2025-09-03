<?php
namespace App\Traits\Filter;

use Illuminate\Validation\Rule;

trait OrderByTrait
{

    public function OrderBy($query) {
        $query->orderBy('created_at','desc');
    }
}
?>

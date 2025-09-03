<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    protected $fillable  = ['id','name','value','key'];

        use HasTranslations;
    public $translatable = ['value'];

    public function getLogo() {
        $row = $this->where('name', 'logo')->first();
        if(!$row) return asset('assets/media/avatars/300-1.jpg');

        $value = json_decode($row->value, true);
        return asset('storage/' . ($value));
    }

    public function getCoverLogo() {
        $row = $this->where('name', 'cover_logo')->first();
        if(!$row) return asset('assets/media/avatars/300-1.jpg');

        $value = json_decode($row->value, true);
        return asset('storage/' . ($value));
    }

    public function getIconLogo() {
        $row = $this->where('name', 'icon_logo')->first();
        if(!$row) return asset('assets/media/avatars/300-1.jpg');

        $value = json_decode($row->value, true);
        return asset('storage/' . ($value ));
    }

}

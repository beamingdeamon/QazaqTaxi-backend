<?php

namespace App\Models;

use App;
use Illuminate\Database\Eloquent\Model;

class LanguageHandymanChargeType extends Model
{
    protected $guarded = [];

    public function LanguageName()
    {
        return $this->belongsTo(Language::class, 'locale', 'locale');
    }
}

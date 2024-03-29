<?php

namespace App\Models\BusinessSegment;

use Illuminate\Database\Eloquent\Model;

class LanguageProduct extends Model
{
    protected $guarded = [];

    public function LanguageName()
    {
        return $this->belongsTo(Language::class, 'locale', 'locale');
    }
}

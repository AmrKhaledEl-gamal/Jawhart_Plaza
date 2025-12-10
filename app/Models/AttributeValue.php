<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class AttributeValue extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = [];
    public $translatable = ['value'];

    // القيمة دي تابعة لسمة معينة (الأحمر تابع للون)
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}

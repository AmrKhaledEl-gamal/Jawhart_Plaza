<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    protected $guarded = [];

    // الاسم والوصف بيترجموا
    public $translatable = ['name', 'description'];

    // المنتج تبع قسم واحد
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // المنتج ليه تفاصيل كتير (ألوان ومقاسات مختلفة)
    // العلاقة دي بتربطنا بجدول الـ Variations
    public function variations()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }
}

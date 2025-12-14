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

    public $translatable = ['name', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function variations()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function minPrice()
    {
        return $this->variants()->min('price');
    }

    public function totalStock()
    {
        return $this->variants()->sum('stock');
    }
}
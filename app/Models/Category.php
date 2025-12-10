<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations; // عشان الترجمة
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia; // عشان الصور

class Category extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    protected $guarded = [];

    // بنحدد الحقول اللي بتتقبل عربي وانجليزي
    public $translatable = ['name'];

    // علاقة: القسم الرئيسي والأقسام الفرعية (Self Referencing)
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // علاقة: القسم بيحتوي على منتجات
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

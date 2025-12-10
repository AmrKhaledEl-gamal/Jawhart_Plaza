<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttributeValue extends Model
{
    use HasFactory;

    // لارافل أوتوماتيك هتربطه بجدول 'product_attribute_values'
    // لو أنت سميت الجدول اسم تاني (مثلاً product_variations)، لازم تكتب هنا:
    // protected $table = 'product_variations';

    protected $guarded = [];

    // علاقة عكسية: عشان نعرف السطر ده تبع انهي منتج
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // علاقة عكسية: عشان نعرف السطر ده تبع انهي قيمة (أحمر ولا أزرق)
    public function attributeValue()
    {
        return $this->belongsTo(AttributeValue::class);
    }
}

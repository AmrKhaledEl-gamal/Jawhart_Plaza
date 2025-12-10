<?php

namespace App\Models;

// 1. ده الكلاس المسؤول عن تسجيل الدخول (مهم جداً بدلاً من Model العادي)
use Illuminate\Foundation\Auth\User as Authenticatable;

// 2. ده استدعاء التريت بتاع Spatie
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasRoles, Notifiable;

    // 3. تحديد الـ Guard عشان الصلاحيات تتفصل عن اليوزر العادي
    protected $guard_name = 'admin';

    // الحقول المسموح بتعبئتها
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // إخفاء الباسورد عند استرجاع البيانات
    protected $hidden = [
        'password',
        'remember_token',
    ];
}

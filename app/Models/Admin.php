<?php

namespace App\Models;

// 1. الاستدعاء الصحيح عشان الـ Login
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

// 2. الوراثة من Authenticatable مش Model
class Admin extends Authenticatable
{
    use HasRoles, Notifiable;

    // 3. تحديد الـ Guard عشان نفصله عن اليوزر
    protected $guard_name = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}

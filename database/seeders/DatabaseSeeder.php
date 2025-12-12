<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // لازم عشان نستخدم DB::table

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // إضافة Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456789'),
        ]);

        // إضافة بيانات افتراضية للـ About
        DB::table('abouts')->insert([
            'about' => 'هذا نص تعريفي تجريبي عن الموقع أو الشركة.',
            'vision' => 'هذه الرؤية التجريبية لتوضيح شكل البيانات.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            [
                'name' => 'التصنيف الاول',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'التصنيف الثانى',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'التصنيق الثالث',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'التصنيف الرابع',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

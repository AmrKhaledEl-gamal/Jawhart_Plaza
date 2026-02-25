<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wholesale', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('sku');
            $table->integer('quantity');
            $table->boolean('has_logo')->default(true);
            $table->text('message');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('wholesale');
    }
};

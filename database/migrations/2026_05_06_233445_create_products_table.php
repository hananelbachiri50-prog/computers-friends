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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('img'); // contiendra 'p1.png', 'p2.jpg', etc.
            $table->json('gallery'); // images secondaires (ex: ["p1-0.jpg","p1-1.jpg"]) 

            $table->string('specs'); // 'i5 8th | 8/256'
            $table->decimal('price', 8, 2);
            $table->text('description')->nullable(); // optionnel pour plus tard

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

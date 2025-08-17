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
        Schema::create('carts', function (Blueprint $table) {
            $table->id('cart_id');
            $table->integer('quantity');
            
            $table->unsignedBigInteger('user_fk');
            $table->unsignedBigInteger('pr_fk');

            $table->foreign('user_fk')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('pr_fk')->references('pr_id')->on('products')->cascadeOnDelete();

            // $table->foreignId('pr_fk')->constrained('products')->cascadeOnDelete();

            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};

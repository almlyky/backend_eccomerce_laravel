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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id('fav_no');
            $table->unsignedBigInteger('user_fk');
            $table->unsignedBigInteger('pr_fk');

            $table->foreign('user_fk')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('pr_fk')->references('pr_id')->on('products')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};

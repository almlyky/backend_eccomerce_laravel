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
            $table->id('pr_id');
            $table->string('pr_name', 50);
            $table->string('pr_name_en', 50);
            $table->string('pr_image');
            $table->integer('pr_cost');
            $table->integer('pr_cost_new')->default(0);
            $table->string('pr_detail', 150);
            $table->string('pr_detail_en', 150);
            $table->integer('pr_discoutn')->default(0);
            $table->unsignedBigInteger('cat_fk');
            $table->foreign('cat_fk')->references('cat_id')->on('categories');
            // $table->foreignId('cat_fk')->constrained('categories')->restrictOnDelete();
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

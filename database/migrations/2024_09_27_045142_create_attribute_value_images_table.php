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
        Schema::create('attribute_value_images', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->default(0);
            $table->bigInteger('attribute_value_id_1')->default(0);
            $table->bigInteger('attribute_value_id_2')->default(0);
            $table->bigInteger('attribute_value_id_3')->default(0);
            $table->bigInteger('attribute_value_image_id')->nullable();
            $table->boolean('status')->default(1);
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->useCurrent();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_value_images');
    }
};

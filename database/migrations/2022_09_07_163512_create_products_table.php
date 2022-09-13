<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_category_id')->references('id')->on('sub_categories');
            $table->string('product_name');
            $table->string('product_slug')->nullable();
            $table->string('keyword')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->longText('description')->nullable();
            $table->longText('content')->nullable();
            $table->longText('manual')->nullable();
            $table->string('youtube_id')->nullable();
            $table->string('measurement')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

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
            $table->uuid('id');
            $table->foreignId('nested_sub_category_id')->references('id')->on('nested_sub_categories');
            $table->foreignId('product_disease_id')->references('id')->on('product_diseases');
            $table->string('product_name');
            $table->integer('price')->nullable();
            $table->integer('discount_price')->nullable();
            $table->string('product_slug')->nullable();
            $table->string('code')->nullable();
            $table->longText('description')->nullable();
            $table->longText('content')->nullable();
            $table->longText('manual')->nullable();
            $table->string('keyword')->nullable();
            $table->string('model')->nullable();
            $table->string('youtube_id')->nullable();
            $table->string('measurement')->nullable();
            $table->integer('discount')->nullable();
            $table->enum('is_variant', ['yes', 'no'])->default('no');
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

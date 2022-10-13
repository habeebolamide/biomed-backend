<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->foreignId('address_id')->references('id')->on('user_addresses');
            $table->string('invoice_id');
            $table->integer('quantity');
            $table->integer('product_price');
            $table->integer('product_discount')->default(0);
            $table->integer('coupon_disount')->default(0);
            $table->enum('status', ['PAID', 'UNPAID'])->default('UNPAID');
            $table->unique([
                'user_id',
                'product_id',
            ]);
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
        Schema::dropIfExists('invoices');
    }
}

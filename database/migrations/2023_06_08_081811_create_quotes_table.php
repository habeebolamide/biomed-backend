<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('quantity');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('company');
            $table->string('phone');
            $table->string('email');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('postcode');
            $table->string('city');
            $table->string('region');
            $table->string('country');
            $table->string('VAT/MwSt Number/Tax ID');
            $table->string('deliverycountry');
            $table->string('deliveryoption');
            $table->string('nearBranch');
            $table->string('comment')->nullable();
            $table->string('reference_id');
            $table->string('price')->nullable();
            $table->enum('status', ['pending', 'quoted'])->default('pending');
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
        Schema::dropIfExists('quotes');
    }
}

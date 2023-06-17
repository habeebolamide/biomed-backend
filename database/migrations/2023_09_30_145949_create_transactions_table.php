<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no');
            $table->foreignId('user_id')->constrained('users');
            $table->string('email')->nullable();
            $table->string('invoice_id')->nullable();
            $table->integer('amount')->default(0);
            $table->integer('expected_amount');
            $table->enum('gateway_type',['autocredit', 'paystack', 'flutterwave'])->nullable();
            $table->enum('status', ['pending','approved','declined'])->default('pending');
            $table->json('raw_response')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}

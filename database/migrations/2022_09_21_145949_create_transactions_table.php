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
            $table->string('reference_no')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('invoice_id')->constrained('invoices');
            $table->integer('amount');
            $table->integer('expected_amount');
            $table->enum('gateway_type',['autocredit', 'paystack', 'flutterwave']);
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

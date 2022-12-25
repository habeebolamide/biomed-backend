<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon')->unique();
            $table->string('description');
            $table->integer('no_of_usage');
            $table->integer('total_used')->default(0);
            $table->integer('percent')->nullable();
            $table->integer('amount')->nullable();
            $table->foreignId('user_id')->nullable()->references('id')->on('users');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->date('expires_at');
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
        Schema::dropIfExists('coupons');
    }
}

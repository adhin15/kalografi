<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('paket_id')->nullable()->constrained('pakets')->onDelete('CASCADE');
            $table->foreignId('custom_id')->nullable()->constrained('customs')->onDelete('CASCADE');
            $table->foreignId('discount_id')->nullable()->constrained('discounts')->onDelete('CASCADE');
            $table->foreignId('printedphoto_id')->nullable()->constrained('printedphotos')->onDelete('CASCADE');
            $table->foreignId('photobook_id')->nullable()->constrained('photobooks')->onDelete('CASCADE');

            $table->string('order_id')->nullable();
            $table->date('bookdate')->nullable();
            $table->integer('ppqty')->nullable();
            $table->integer('pbqty')->nullable();
            $table->string('venue')->nullable();
            $table->string('tone')->nullable();
            $table->string('weddingstyle')->nullable();
            $table->string('fullname')->nullable();
            $table->string('email')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('address')->nullable();
            $table->string('additionals')->nullable();
            $table->integer('payment_termination')->nullable();
            $table->integer('totalprice');
            $table->integer('downPayment')->nullable();
            $table->integer('installment')->nullable();
            $table->enum('paymentStatus', ['CREATED', 'FULL_PAYMENT_PENDING', 'FULLY_PAID', 'DOWN_PAYMENT_PENDING', 'DOWN_PAYMENT_PAID', 'INSTALLMENT_PENDING', 'INSTALLMENT_PAID'])->default('CREATED');
            $table->string('paymentToken')->nullable();

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
        Schema::dropIfExists('bookings');
    }
}

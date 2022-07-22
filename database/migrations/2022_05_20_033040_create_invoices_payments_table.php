<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('PaymentMethod');
            $table->decimal('Amount',8,2);
            $table->string('Date');
            $table->string('PaymentId')->nullable();
            $table->string('Note')->nullable();
            $table->unsignedBigInteger('UserId');
            $table->unsignedBigInteger('InvoiceId');
            $table->unsignedBigInteger('ClientId');
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
        Schema::dropIfExists('invoices_payments');
    }
};

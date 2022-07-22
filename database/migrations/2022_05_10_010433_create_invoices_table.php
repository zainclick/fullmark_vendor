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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('InvoiceNumber');
            $table->unsignedBigInteger('ClientCode');
            $table->unsignedBigInteger('PaymentMethod');
            $table->unsignedBigInteger('PaymentId')->nullable();
            $table->string('Date');
            $table->decimal('Discount',8,2)->nullable();
            $table->decimal('Tax',8,2)->nullable();
            $table->decimal('TaxAmount',8,2)->nullable();
            $table->decimal('PaymentAmount',8,2)->nullable();
            $table->decimal('Total',8,2);
            $table->string('Image')->nullable();
            $table->string('Address')->nullable();
            $table->string('Details')->nullable();
            $table->string('Currency');
            $table->integer('Status');
            $table->unsignedBigInteger('UserId');
            $table->unsignedBigInteger('ClientId');
            $table->softDeletes();
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
};

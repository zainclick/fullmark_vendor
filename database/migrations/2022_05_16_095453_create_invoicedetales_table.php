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
        Schema::create('invoicedetales', function (Blueprint $table) {
            $table->id();
            $table->string('Barcode');
            $table->unsignedBigInteger('Product_Id');
            $table->integer('Quantity');
            $table->decimal('Product_Price','8','2');
            $table->decimal('Discount','8','2');
            $table->decimal('Tax','8','2');
            $table->decimal('Total','8','2');
            $table->unsignedBigInteger('InvoiceId');
            $table->unsignedBigInteger('UserId');
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
        Schema::dropIfExists('invoicedetales');
    }
};

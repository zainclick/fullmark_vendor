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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Slug');
            $table->string('Description')->nullable();
            $table->integer('Quantity');
            $table->decimal('Discount','8','2')->nullable();
            $table->decimal('BuyPrice','8','2');
            $table->decimal('SalePrice','8','2');
            $table->string('Barcode');
            $table->integer('Notify')->nullable();
            $table->integer('Less_Quantity')->nullable();
            $table->unsignedBigInteger('Category_Id');
            $table->unsignedBigInteger('Store_Id');
            $table->unsignedBigInteger('Unit_Id');
            $table->unsignedBigInteger('Tax_Id',);
            $table->unsignedBigInteger('User_Id',);
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
        Schema::dropIfExists('products');
    }
};

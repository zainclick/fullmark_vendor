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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Slug');
            $table->string('Email');
            $table->string('Phone');
            $table->string('First_Name');
            $table->string('Last_Name');
            $table->string('Streat');
            $table->string('City');
            $table->integer('Post');
            $table->string('Country');
            $table->string('Currency');
            $table->string('Barcode');
            $table->string('Avatar')->nullable();
            $table->string('Tax_Cridet')->nullable();
            $table->string('Record')->nullable();
            $table->string('Notes')->nullable();
            $table->unsignedBigInteger('User_Id');
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
        Schema::dropIfExists('clients');
    }
};

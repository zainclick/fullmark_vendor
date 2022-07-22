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
        Schema::create('sessions_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('amount');
            $table->unsignedBigInteger('level');
            $table->integer('duration');
            $table->unsignedBigInteger('teacher');
            $table->integer('payment_status');
            $table->string('date_start')->nullable();
            $table->string('date_end')->nullable();
            $table->string('time_start')->nullable();
            $table->string('time_end')->nullable();
            $table->string('video')->nullable();
            $table->string('image')->nullable();
            $table->integer('download')->nullable();
            $table->unsignedBigInteger('course')->nullable();   
            $table->integer('status');         
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
        Schema::dropIfExists('sessions_items');
    }
};

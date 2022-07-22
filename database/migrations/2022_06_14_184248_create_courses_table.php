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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('amount_before')->nullable();
            $table->string('amount_after');
            $table->unsignedBigInteger('teacher');
            $table->unsignedBigInteger('level');
            $table->integer('payment_status');
            $table->string('date_start')->nullable();
            $table->string('date_end')->nullable();
            $table->string('time_start')->nullable();
            $table->string('time_end')->nullable();
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
        Schema::dropIfExists('courses');
    }
};

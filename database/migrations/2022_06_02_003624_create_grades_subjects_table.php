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
        Schema::create('grades_subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Subject');
            $table->unsignedBigInteger('Grades_Sections');
            $table->unsignedBigInteger('Grade');
            $table->integer('Status');
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
        Schema::dropIfExists('grades_subjects');
    }
};

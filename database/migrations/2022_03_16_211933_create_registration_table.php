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
        if(!Schema::hasTable('registration')){
            Schema::create('registration', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('student_id')->nullable(false);
                $table->foreign('student_id')->references('id')->on('student');
                $table->unsignedBigInteger('course_id')->nullable(false);
                $table->foreign('course_id')->references('id')->on('course');
                $table->timestamp('registered_on')->useCurrent();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registration');
    }
};

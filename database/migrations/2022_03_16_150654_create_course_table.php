<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('course')){
            Schema::create('course', function (Blueprint $table) {
                $table->id();
            });

            DB::statement('ALTER TABLE course
            ADD COLUMN name VARCHAR(255) NOT NULL CHECK(BINARY name = LOWER(name))');
    
            DB::statement('ALTER TABLE course
            ADD COLUMN capacity TINYINT NOT NULL CHECK(BINARY capacity >=3 AND capacity <=8)');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course');
    }
};

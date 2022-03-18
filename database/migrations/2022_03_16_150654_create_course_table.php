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

            // adding column nam with only lowercase value constraint
            DB::statement('ALTER TABLE course
            ADD COLUMN name VARCHAR(255) NOT NULL CHECK(BINARY name = LOWER(name))');

            // adding column capacity with constraint (only the value between 3 and 8 including both)
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

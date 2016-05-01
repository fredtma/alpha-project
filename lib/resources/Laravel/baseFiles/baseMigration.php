<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClassNameTableName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('{tables}', function (Blueprint $table) {
            $table->increments('id');
        {fields}
            $table->timestamps();

            //DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        {foreign}
            //DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('{tables}');
    }
}

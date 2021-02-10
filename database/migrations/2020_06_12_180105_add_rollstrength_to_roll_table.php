<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRollstrengthToRollTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rollmappings', function (Blueprint $table) {
            $table->string('roll_strength')->after('roll_week')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rollmappings', function (Blueprint $table) {
            $table->dropColumn('roll_strength');
        });
    }
}

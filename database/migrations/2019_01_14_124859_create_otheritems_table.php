<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtheritemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otheritems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id');
            $table->integer('item_id');
            $table->string('string');
            $table->decimal('amount');
            $table->string('paid');
            $table->date('date');
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
        Schema::dropIfExists('otheritems');
    }
}

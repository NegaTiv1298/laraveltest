<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_link', function (Blueprint $table) {
            $table->id();
            $table->string('request_link');
            $table->string('token_link')->unique();
            $table->integer('count_limit')->default(0);
            $table->integer('attendance_limit')->default(0);
            $table->dateTime('time_to_die');
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
        Schema::dropIfExists('short_link');
    }
}

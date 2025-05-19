<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('web_crawler_check_id')->constrained();
            $table->foreignId('majestic_check_id')->constrained();
            $table->foreignId('moz_check_id')->constrained();
            $table->string('commentary', 500)->nullable();
            $table->dateTime('measured_at');
            $table->dateTime('latest_scan')->nullable();
            $table->dateTime('latest_scan_update')->nullable();
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
        Schema::dropIfExists('checks');
    }
}

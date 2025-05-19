<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMajesticChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('majestic_checks', function (Blueprint $table) {
            $table->id();
            $table->string('domain_name', 500);
            $table->smallInteger('citation_flow');
            $table->smallInteger('trust_flow');
            $table->dateTime('indexed_at');
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
        Schema::dropIfExists('majestic_checks');
    }
}

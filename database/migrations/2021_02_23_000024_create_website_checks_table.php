<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_id')->constrained();
            $table->smallInteger('domain_authority');
            $table->smallInteger('citation_flow');
            $table->smallInteger('trust_flow');
            $table->dateTime('datetime');
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
        Schema::dropIfExists('website_checks');
    }
}

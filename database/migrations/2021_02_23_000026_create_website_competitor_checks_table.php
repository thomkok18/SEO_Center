<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteCompetitorChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_competitor_checks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('website_id')->nullable();
            $table->foreign('website_id')->references('id')->on('competitor_websites');
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
        Schema::dropIfExists('website_competitor_checks');
    }
}

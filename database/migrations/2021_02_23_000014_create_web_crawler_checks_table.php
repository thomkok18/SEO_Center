<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebCrawlerChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_crawler_checks', function (Blueprint $table) {
            $table->id();
            $table->string('domain_name', 500);
            $table->string('server_ip', 20)->nullable();
            $table->smallInteger('http_status')->nullable();
            $table->string('page_language', 2)->nullable();
            $table->string('page_title', 80)->nullable();
            $table->string('page_description', 200)->nullable();
            $table->dateTime('measured_at');
            $table->mediumInteger('follow_internal_links')->nullable();
            $table->mediumInteger('no_follow_internal_links')->nullable();
            $table->mediumInteger('follow_external_links')->nullable();
            $table->mediumInteger('no_follow_external_links')->nullable();
            $table->mediumInteger('follow_social_links')->nullable();
            $table->mediumInteger('no_follow_social_links')->nullable();
            $table->mediumInteger('follow_customer_links')->nullable();
            $table->mediumInteger('no_follow_customer_links')->nullable();
            $table->mediumInteger('follow_competitor_links')->nullable();
            $table->mediumInteger('no_follow_competitor_links')->nullable();
            $table->mediumInteger('image_count')->nullable();
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
        Schema::dropIfExists('web_crawler_checks');
    }
}

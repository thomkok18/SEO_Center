<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_urls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('companies');
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('companies');
            $table->foreignId('url_type_id')->constrained();
            $table->unsignedBigInteger('conclusion_id');
            $table->foreign('conclusion_id')->references('id')->on('conclusion_types');
            $table->foreignId('website_id')->nullable()->constrained();
            $table->unsignedBigInteger('price_type_id')->nullable();
            $table->foreign('price_type_id')->references('id')->on('price_types');
            $table->string('promotion_url', 500);
            $table->decimal('custom_price', 6)->nullable();
            $table->boolean('archived');
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
        Schema::dropIfExists('promotion_urls');
    }
}

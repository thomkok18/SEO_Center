<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailto_links', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', 50);
            $table->string('inserts', 50)->nullable();
            $table->string('lastname', 50);
            $table->string('email', 50)->unique();
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
        Schema::dropIfExists('mailto_links');
    }
};

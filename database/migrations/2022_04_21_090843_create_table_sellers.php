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
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_type_id');
            $table->foreign('seller_type_id')->references('id')->on('seller_type')->onDelete('NO ACTION');
            $table->string('name');
            $table->string('address');
            $table->text('description');
            $table->string('phone_number');
            $table->string('background_image');
            $table->string('logo');
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
        Schema::dropIfExists('table_sellers');
    }
};

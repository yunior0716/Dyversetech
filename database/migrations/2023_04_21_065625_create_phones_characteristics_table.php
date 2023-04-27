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
        Schema::create('phones_characteristics', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('characteristic_id');
            $table->string('characteristic_value');
            $table->timestamps();


            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('characteristic_id')->references('characteristics_id')->on('characteristics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('phones__characteristics', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['characteristic_id']);
        });

        Schema::dropIfExists('phones__characteristics');
    }
};

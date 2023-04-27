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
        Schema::create('filters_characteristics', function (Blueprint $table) {
            $table->unsignedBigInteger('filter_id');
            $table->unsignedBigInteger('characteristic_id');
            $table->string('min_value');
            $table->string('max_value');
            $table->timestamps();


            $table->foreign('filter_id')->references('filter_id')->on('filters')->onDelete('cascade');
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

        
        Schema::table('filters_characteristics', function (Blueprint $table) {
            $table->dropForeign(['filter_id']);
            $table->dropForeign(['characteristic_id']);
        });



        Schema::dropIfExists('filters_characteristics');
    }
};

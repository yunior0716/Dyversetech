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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('model_id');
            $table->unsignedBigInteger('operator_id');
            $table->string('description');
            $table->string('image');
            $table->string('catagory');
            $table->string('quantity');
            $table->double('price');
            $table->string('discount_price')->nullable();
            $table->unsignedBigInteger('imei')->nullable()->length(15);
            $table->string('condition');    
            $table->timestamps();

            $table->foreign('model_id')->references('model_id')->on('models')->onDelete('cascade');
            $table->foreign('operator_id')->references('operator_id')->on('operators')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['model_id']);
            $table->dropForeign(['operator_id']);
        });
        
        Schema::dropIfExists('products');
    }
};
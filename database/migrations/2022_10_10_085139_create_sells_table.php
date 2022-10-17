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
        Schema::create('sells', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("product_1_id")->unsigned()->nullable();
            $table->integer("product_1_qtd")->unsigned()->nullable();
            $table->integer("product_2_id")->unsigned()->nullable();
            $table->integer("product_2_qtd")->unsigned()->nullable();
            $table->integer("product_3_id")->unsigned()->nullable();
            $table->integer("product_3_qtd")->unsigned()->nullable();
            $table->integer("product_4_id")->unsigned()->nullable();
            $table->integer("product_4_qtd")->unsigned()->nullable();
            $table->integer("product_5_id")->unsigned()->nullable();
            $table->integer("product_5_qtd")->unsigned()->nullable();
            $table->integer("product_6_id")->unsigned()->nullable();
            $table->integer("product_6_qtd")->unsigned()->nullable();
            $table->integer("product_7_id")->unsigned()->nullable();
            $table->integer("product_7_qtd")->unsigned()->nullable();
            $table->integer("product_8_id")->unsigned()->nullable();
            $table->integer("product_8_qtd")->unsigned()->nullable();
            $table->integer("product_9_id")->unsigned()->nullable();
            $table->integer("product_9_qtd")->unsigned()->nullable();
            $table->integer('fpay_id')->unsigned();
            $table->string('description_service');
            $table->decimal('price',10,2);            
            $table->decimal('discount',10,2)->nullable();
            $table->decimal('tariff',10,2)->nullable();
            $table->decimal('total',10,2)->nullable();
            $table->string('document')->nullable()->unique();

            $table->timestamps();

            $table->foreign('product_1_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_2_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_3_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_4_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_5_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_6_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_7_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_8_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_9_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('fpay_id')->references('id')->on('fpays')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sells');
    }
};

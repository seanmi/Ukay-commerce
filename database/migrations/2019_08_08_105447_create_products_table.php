<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('seller_id')->unsigned();
            $table->string('name');
            $table->integer('quantity');
            $table->string('code')->nullable();
            $table->string('image');
            $table->string('profile');
            $table->decimal('price', 10,2);
            $table->decimal('additional_price', 10,2);
            $table->integer('category_id')->unsigned();
            $table->integer('size_num')->nullable();
            $table->string('size');
            $table->string('color');
            $table->integer('status_id')->unsigned();
            $table->Longtext('details');
            $table->date('expired_at')->nullable();
            $table->integer('discount_id')->unsigned()->nullable();
            $table->decimal('deduction', 10,2)->default(0.00);
            $table->date('received_at')->nullable();
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
        Schema::dropIfExists('products');
    }
}

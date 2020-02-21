<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('productName',70);
            $table->integer('stock');
            $table->decimal('purchasePrice', 8, 2);
            $table->decimal('salePrice', 8, 2);
            $table->string('description',500);
            $table->unsignedInteger('soldout')->default(0);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')
                    ->onDelete('set null')
                    ->onUpdate('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')
                    ->onDelete('set null')
                    ->onUpdate('cascade');
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

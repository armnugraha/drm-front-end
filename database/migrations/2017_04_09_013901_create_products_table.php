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
            $table->increments('id');
            $table->string('name', 60)->nullable();
            $table->string('barcode')->nullable()->unique()->index();
            $table->unsignedInteger('pcs_price')->nullable()->default(0);
            $table->unsignedInteger('dozen_price')->nullable()->default(0);
            $table->unsignedInteger('pack_price')->nullable()->default(0);
            $table->unsignedInteger('box_price')->nullable()->default(0);
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

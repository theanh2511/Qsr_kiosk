<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFSalesDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_sales_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('SaleId')->default('-1');
            $table->integer('DetailNo')->default('0');
            $table->string('ProductCode', 32)->default('');
            $table->string('ProductName', 128)->default('');
            $table->string('Unit', 32)->default('');

            $table->double('Quantity', 15, 4)->default('0');
            $table->double('UnitPrice', 18, 2)->default('0');
            $table->double('Amount', 18, 2)->default('0');
            $table->float('DiscountRate', 5, 4)->default('0');
            $table->double('DiscountAmount', 18, 2)->default('0');

            $table->boolean('IsActive')->default('1');
            $table->integer('CreatedBy')->default('-1');
            $table->dateTime('CreatedAt')->nullable();
            $table->integer('ModifiedBy')->default('-1');
            $table->dateTime('ModifiedAt')->nullable();
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
        Schema::dropIfExists('f_sales_detail');
    }
}

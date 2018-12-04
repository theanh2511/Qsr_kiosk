<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_discount', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('BizDocId')->default('-1');
            $table->integer('DetailNo')->default('0');
            $table->string('ProductCode', 32)->default('');
            $table->string('ProductName', 128)->default('');
            $table->string('Unit', 32)->default('');

            $table->double('Quantity', 15, 4)->default('0');
            $table->float('DiscountRate', 5, 4)->default('0');
            $table->double('DiscountAmount', 18, 2)->default('0');

            $table->boolean('SaleWithCode')->default('0');
            $table->string('SaleCode', 32)->default('');
            $table->boolean('IsActive')->default('1');
            $table->integer('CreatedBy')->default('-1');
            $table->timestamp('CreatedAt')->nullable();
            $table->integer('ModifiedBy')->default('-1');
            $table->timestamp('ModifiedAt')->nullable();
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
        Schema::dropIfExists('f_discount');
    }
}

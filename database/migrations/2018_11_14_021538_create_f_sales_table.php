<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FiscalYear')->default('-1');
            $table->date('DocDate')->nullable();
            $table->string('DocNo', 24)->default('');
            $table->string('CustomerCode', 32)->default('');
            $table->string('Description', 128)->default('');

            $table->float('DiscountRate', 5, 4)->default('0');
            $table->double('DiscountAmount', 18, 2)->default('0');
            $table->double('TotalDetailAmount', 18, 2)->default('0');
            $table->double('TotalDetailDiscountAmount', 18, 2)->default('0');
            $table->double('TotalTaxAmount', 18, 2)->default('0');
            $table->double('TotalAmount', 18, 2)->default('0');
            $table->string('PaymentTerm', 24)->default('');
            $table->boolean('IsPayment')->default('0');

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
        Schema::dropIfExists('f_sales');
    }
}

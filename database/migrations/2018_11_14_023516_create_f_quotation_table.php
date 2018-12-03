<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFQuotationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_quotation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('BizDocId')->default('-1');
            $table->integer('DetailNo')->default('-1');
            $table->string('ProductCode', 32)->default('');
            $table->string('ProductName', 128)->default('');
            $table->string('Unit', 32)->default('');

            $table->double('UnitPrice', 18, 2)->default('0');

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
        Schema::dropIfExists('f_quotation');
    }
}

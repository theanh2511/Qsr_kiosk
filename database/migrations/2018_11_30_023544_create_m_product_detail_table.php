<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMProductDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_product_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('DetailNo')->default('-1');
            $table->string('ParentProductCode', 32)->default('');
            $table->string('ChildProductCode', 32)->default('');
            $table->double('Quantity', 8, 2)->default('0');
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
    public
    function down()
    {
        Schema::dropIfExists('m_product_detail');
    }
}

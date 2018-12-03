<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ParentId')->default('-1');
            $table->string('Code', 32)->unique();
            $table->string('Name', 128)->default('');
            $table->string('Unit', 32)->default('');
            $table->double('UnitCost', 18, 2)->default('0');
            $table->double('UnitPrice', 18, 2)->default('0');
            $table->string('ProductInfo', 4000)->default('');
            $table->string('Description', 4000)->default('');
            $table->integer('ItemType')->default('-1');
            $table->string('CatalogCode', 24)->default('');
            $table->string('ImageUrl', 128)->default('');
            $table->string('VideoUrl', 128)->default('');
            $table->boolean('IsGetChildPrice')->default('1');
            $table->integer('Rank')->default('1');
            $table->boolean('StopBusiness')->default('0');
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
        Schema::dropIfExists('m_products');
    }
}

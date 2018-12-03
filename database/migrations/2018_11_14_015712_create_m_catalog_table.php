<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMCatalogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_catalogs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ParentId');
            $table->string('Code', 32)->unique();
            $table->string('Name', 128);
            $table->string('Description', 500)->default('');
            $table->string('ImageUrl', 128)->default('');
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
        Schema::dropIfExists('m_catalogs');
    }
}

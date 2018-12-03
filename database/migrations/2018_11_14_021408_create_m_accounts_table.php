<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Code', 32)->unique();
            $table->string('FullName', 128);
            $table->string('Person', 128);
            $table->string('Tel', 32);
            $table->string('Mobile', 32);
            $table->string('Fax', 32);
            $table->string('Address', 128);
            $table->string('Description', 128);

            $table->boolean('IsActive');
            $table->integer('CreatedBy');
            $table->timestamp('CreatedAt')->nullable();
            $table->integer('ModifiedBy');
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
        Schema::dropIfExists('m_accounts');
    }
}

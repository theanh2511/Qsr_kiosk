<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFBizdocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_bizdoc', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FiscalYear')->default('-1');
            $table->string('BizType', 2)->default('');
            $table->date('DocDate')->nullable();
            $table->date('EffectiveDate_Fr')->nullable();
            $table->date('EffectiveDate_To')->nullable();
            $table->string('DocNo', 24)->default('');
            $table->string('Description', 128)->default('');

            $table->boolean('IsActive')->default(1);
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
        Schema::dropIfExists('f_bizdoc');
    }
}

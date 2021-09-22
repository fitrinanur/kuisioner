<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('questionId')->unsigned()->index();
            $table->foreign('questionId')->references('id')->on('questions')->onDelete('cascade');
            $table->string('optionName')->nullable();
            $table->string('optionImg')->nullable();
            $table->integer('isRadius')->default(0)->nullable();
            $table->integer('isCircle')->default(0)->nullable();
            $table->integer('active')->default(1);
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
        Schema::dropIfExists('options');
    }
}

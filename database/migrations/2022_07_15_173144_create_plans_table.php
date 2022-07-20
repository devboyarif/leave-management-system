<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->enum('type', ['free', 'paid'])->default('free');
            $table->float('price');
            $table->boolean('status')->default(true);
            $table->boolean('recommended')->default(false);
            $table->integer('order')->default(0);
            $table->enum('interval', ['monthly', 'yearly', 'custom_date', 'lifetime'])->nullable();
            $table->unsignedBigInteger('custom_interval_days')->nullable();
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
        Schema::dropIfExists('plans');
    }
}

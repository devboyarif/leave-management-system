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
            $table->unsignedBigInteger('price')->default(0);
            $table->boolean('status')->default(true);
            $table->enum('interval', ['monthly', 'yearly', 'custom_days', 'lifetime'])->nullable();
            $table->unsignedBigInteger('custom_interval_days')->nullable();
            $table->boolean('recommended')->default(false);
            $table->boolean('default')->default(false);
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

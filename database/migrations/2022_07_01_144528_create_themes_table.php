<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            // Admin colors
            $table->string('primary_color')->default('#0984e3');
            $table->string('hover_color')->default('#4487ba');
            $table->string('secondary_color')->default('#596275');
            $table->string('success_color')->default('#2ecc71');
            $table->string('info_color')->default('#17a2b8');
            $table->string('warning_color')->default('#eab308');
            $table->string('danger_color')->default('#eb4d4b');

            // Website colors
            $table->string('website_primary_color')->default('#0984e3');
            $table->string('website_heading_text_color')->default('#212b36');
            $table->string('website_body_text_color')->default('#596275');
            $table->string('website_secondary_color')->default('#ffffff');
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
        Schema::dropIfExists('themes');
    }
}

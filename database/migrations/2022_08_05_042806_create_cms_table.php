<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms', function (Blueprint $table) {
            $table->id();

            // Home page
            $table->string('home_banner_title');
            $table->string('home_banner_description');
            $table->string('home_banner_button_text');
            $table->string('home_banner_button2_text');
            $table->string('home_banner_button_url');
            $table->string('home_banner_button2_url');
            $table->string('home_feature_title');
            $table->string('home_feature_subtitle');
            $table->string('home_feature_description');

            // About page
            $table->string('about_title');
            $table->string('about_subtitle');
            $table->longText('about_description');
            $table->string('about_image');

            // Pricing page
            $table->string('pricing_plan_title');
            $table->string('pricing_plan_description');

            // Testimonial page
            $table->string('testimonial_title');
            $table->string('testimonial_subtitle');
            $table->text('testimonial_description');

            // Faq page
            $table->string('faq_title');
            $table->string('faq_subtitle');
            $table->text('faq_description');

            // Contact page
            $table->string('contact_title');
            $table->string('contact_subtitle');

            // Terms & Privacy page
            $table->longText('terms_description');
            $table->longText('privacy_description');


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
        Schema::dropIfExists('cms');
    }
}

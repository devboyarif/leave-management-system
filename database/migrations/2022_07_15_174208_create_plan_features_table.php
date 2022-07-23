<?php

use App\Models\Plan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_features', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Plan::class)->constrained()->cascadeOnDelete();
            $table->boolean('is_limited_employee')->default(1);
            $table->unsignedInteger('max_employees')->default(10);
            $table->unsignedInteger('max_teams')->default(2);
            $table->unsignedInteger('max_leave_types')->default(2);
            $table->boolean('custom_theme_look')->default(0);
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
        Schema::dropIfExists('plan_features');
    }
}

<?php

use App\Models\Company;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_themes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete();
            $table->string('primary_color')->default('#3498db');
            $table->string('hover_color')->default('#91c0e0');
            $table->string('secondary_color')->default('#596275');
            $table->string('success_color')->default('#2ecc71');
            $table->string('info_color')->default('#17a2b8');
            $table->string('warning_color')->default('#eab308');
            $table->string('danger_color')->default('#eb4d4b');
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
        Schema::dropIfExists('company_themes');
    }
}

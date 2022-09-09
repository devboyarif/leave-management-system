<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable();
            $table->enum('role', ['admin', 'owner', 'employee'])->default('owner');
            $table->unsignedBigInteger('current_company_id')->nullable();
            $table->boolean('is_opening_setup_complete')->default(0);
            $table->unsignedInteger('opening_setup_steps')->default(1);
            $table->boolean('status')->default(true);
            $table->integer('code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}

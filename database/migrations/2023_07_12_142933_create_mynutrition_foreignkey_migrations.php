<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        // Schema::table('meal', function(Blueprint $table) {

        // });

        // Schema::create('mynutrition_foreignkey_migrations', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });

        Schema::table('meal', function(Blueprint $table) {

            $table->foreign('food_id')->references('id')->on('food');
            $table->foreign('serving_unit_id')->references('id')->on('serving_unit');

        });

        Schema::table('macronutrients', function(Blueprint $table) {
            
            $table->foreign('food_id')->references('id')->on('food');
            $table->foreign('serving_unit_id')->references('id')->on('serving_unit');

        });

        Schema::table('user_configuration', function(Blueprint $table) {
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('weight_unit_id')->references('id')->on('weight_unit');
            $table->foreign('height_unit_id')->references('id')->on('height_unit');


        });

        Schema::table('user_health_details', function(Blueprint $table) {
            
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('user_health_logs', function(Blueprint $table) {
            
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('mynutrition_foreignkey_migrations');
    }
};

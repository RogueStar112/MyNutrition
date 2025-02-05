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
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('source_id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('img_url', 256)->nullable();
            $table->string('description', 256)->nullable();

        });

        Schema::create('food_source', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
        });


        Schema::create('meal', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->unsignedBigInteger('user_id');
            $table->dateTime('time_planned');
            $table->timestamps();
            $table->integer('is_eaten');
            $table->integer('is_notified')->nullable();
        });

        Schema::create('meal_items', function (Blueprint $table) {

            $table->id();
            $table->string('name', 64);
            $table->unsignedBigInteger('meal_id');
            $table->unsignedBigInteger('food_id');
            $table->unsignedBigInteger('food_unit_id');
            $table->float('serving_size', 8, 1);
            $table->float('quantity', 8, 1);
            $table->timestamps();

        });

        Schema::create('macronutrients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('food_id');
            $table->unsignedBigInteger('food_unit_id');
            // $table->integer('serving_unit_id');
            $table->float('serving_size', 8, 1);
            $table->float('calories', 8, 1)->nullable();
            $table->float('fat', 8, 1)->nullable();
            $table->float('carbohydrates', 8, 1)->nullable();
            $table->float('protein', 8, 1)->nullable();


        });

        Schema::create('serving_unit', function (Blueprint $table) {
            $table->id();
            $table->string('name', 16);
            $table->float('size', 8, 2);
        });

        Schema::create('weight_unit', function (Blueprint $table) {
            $table->id();
            $table->string('name', 16);
            $table->float('conversion_value', 8, 2);
        });

        Schema::create('height_unit', function (Blueprint $table) {
            $table->id();
            $table->string('name', 16);
            $table->float('conversion_value', 8, 2);
        });

        Schema::create('user_configuration', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('weight_unit_id');
            $table->unsignedBigInteger('height_unit_id');
        });

        Schema::create('user_health_details', function (Blueprint $table) {

            $table->id();
            $table->float('weight', 5, 2)->nullable();
            $table->float('height', 5, 2)->nullable();
            $table->float('bmi', 3, 1)->nullable();
            $table->float('bodyfat', 3, 1)->nullable();
            $table->timestamp('last_updated');


        });

        Schema::create('user_health_logs', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->float('weight', 5, 2)->nullable();
            $table->float('height', 5, 2)->nullable();
            $table->float('bmi', 3, 1)->nullable();
            $table->float('bodyfat', 3, 1)->nullable();
            $table->timestamp('time_updated');


        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('mynutrition_database');
    }
};

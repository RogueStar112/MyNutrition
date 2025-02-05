<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        

        // Schema::create('', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });

        // DB::table('weight_unit')->insert([
        //     ['name' => 'kilogram', 'conversion_value' => 1],
        //     ['name' => 'pound', 'conversion_value' => 2.20462],
        //     ['name' => 'stone', 'conversion_value' => 0.157473]
        // ]);

        // DB::table('height_unit')->insert([
        //     ['name' => 'centimeter', 'conversion_value' => 0.01],
        //     ['name' => 'meter', 'conversion_value' => 1],
        //     ['name' => 'inch', 'conversion_value' => 0.025],
        //     ['name' => 'feet', 'conversion_value' => 0.03048]
        // ]);

        // DB::table('serving_unit')->insert([
        //     ['name' => '100g', 'size' => 100],
        //     ['name' => 'g', 'size' => 1],
        //     ['name' => 'pc', 'size' => 1]
        // ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('unit_insertion');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Water;
use App\Models\FluidType;

use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('fluid_type', function (Blueprint $table) {
            $table->string('name');
        });

        DB::table('fluid_type')->insert([
            ['name' => 'water'],
            ['name' => 'coke'],
            ['name' => 'milk'],
            ['name' => 'fruit']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};

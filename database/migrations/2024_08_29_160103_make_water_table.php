<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('water', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('fluid_id');
            $table->integer('amount');
            $table->timestamp('time_taken');
            $table->timestamps();
        });

        Schema::create('fluid_type', function (Blueprint $table) {
            $table->id();
            $table->integer('name');
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
        Schema::dropIfExists('water');
        Schema::dropIfExists('fluid_type');
    }
};

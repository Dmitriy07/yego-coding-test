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
        Schema::create('scooter_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scooter_id');
            $table->float('lat');
            $table->float('lng');
            $table->tinyInteger('battery');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scooter_statuses');
    }
};

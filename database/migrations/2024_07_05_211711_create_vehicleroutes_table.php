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
        Schema::create('vehicleroutes', function (Blueprint $table) {
            $table->id();
            $table->date('date_route');
            $table->string('description')->nullable();
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->foreignId('route_id')->constrained('routes');
            $table->foreignId('routestatus_id')->constrained('routestatuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicleroutes');
    }
};

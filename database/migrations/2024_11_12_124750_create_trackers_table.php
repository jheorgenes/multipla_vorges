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
        Schema::create('trackers', function (Blueprint $table) {
            $table->id();
            $table->string('imei');
            $table->foreignId('brand_id')->constrained('brands');
            $table->string('model');
            $table->enum('gps', ['Chip', 'Satelite'])->default('Chip');
            $table->foreignId('operator_id')->constrained('operators');
            $table->foreignId('sim_card_id')->constrained('sim_cards');
            $table->enum('situationTracker', ['Disponivel', 'ComDefeito', 'Instalado'])->default('Disponivel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trackers');
    }
};

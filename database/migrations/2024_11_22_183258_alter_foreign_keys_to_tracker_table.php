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
        // Remove as chaves estrangeiras existentes e colunas
        Schema::table('trackers', function (Blueprint $table) {
            $table->dropForeign(['operator_id']);
            $table->dropColumn('operator_id');
            $table->dropForeign(['sim_card_id']);
            $table->dropColumn('sim_card_id');
        });

        // Cria a tabela pivot para trackers e sim_cards
        Schema::create('tracker_sim_card', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tracker_id')->constrained('trackers')->onDelete('cascade');
            $table->foreignId('sim_card_id')->constrained('sim_cards')->onDelete('cascade');
            $table->timestamps();
        });

        // Cria a tabela pivot para trackers e operators
        Schema::create('tracker_operator', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tracker_id')->constrained('trackers')->onDelete('cascade');
            $table->foreignId('operator_id')->constrained('operators')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop tabelas pivot
        Schema::dropIfExists('tracker_operator');
        Schema::dropIfExists('tracker_sim_card');

        // Adiciona de volta as colunas e chaves estrangeiras na tabela trackers
        Schema::table('tracker', function (Blueprint $table) {
            $table->foreignId('operator_id')->constrained('operators');
            $table->foreignId('sim_card_id')->constrained('sim_cards');
        });
    }
};

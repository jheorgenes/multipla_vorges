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
        Schema::table('service_orders', function (Blueprint $table) {
            // Adiciona as colunas de chave estrangeira
            $table->foreignId('table_service_id')->nullable()->constrained('table_services');
            $table->foreignId('regional_id')->nullable()->constrained('regionals');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_orders', function (Blueprint $table) {
            $table->dropForeign(['table_service_id']);
            $table->dropColumn('table_service_id');

            $table->dropForeign(['regional_id']);
            $table->dropColumn('regional_id');
        });
    }
};

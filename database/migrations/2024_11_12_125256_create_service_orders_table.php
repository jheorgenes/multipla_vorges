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
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('service')->unique();
            $table->date('date');
            $table->string('associate');
            $table->string('plate', 8);
            $table->double('total_value');
            $table->date('payment_date')->nullable();
            $table->enum('situationOS', ['Finalizada', 'Executada', 'Pendente'])->default('Pendente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_orders');
    }
};

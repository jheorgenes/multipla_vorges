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
        Schema::create('webhooks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('url_webhook')->noNullable();
            $table->enum('type_webhook', ['Cadastro', 'Atualizacao', 'Remocao'])->nullable();
            $table->json('models_webhook'); //Para salvar os resources monitorados
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('webhooks');
    }
};

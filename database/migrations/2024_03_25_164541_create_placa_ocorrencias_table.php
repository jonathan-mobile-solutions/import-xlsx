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
        Schema::create('placa_ocorrencias', function (Blueprint $table) {
            $table->id();
            $table->string('arquivo')->comment('nome do arquivo');
            $table->string('ocorrencia')->comment('leilao/cautelar/furto');
            $table->string('placa')->comment('placa do veiculo');
            $table->string('cidade')->nullable()->comment('cidade');
            $table->string('estado')->nullable()->comment('estado');
            $table->string('data')->nullable()->comment('data da ocorrencia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('placa_ocorrencias');
    }
};

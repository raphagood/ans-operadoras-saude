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
        Schema::create('operadora', function (Blueprint $table) {
            $table->id();
            $table->string('registro_ans')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('razao_social')->nullable();
            $table->string('nome_fantasia')->nullable();
            $table->string('ativa')->nullable();
            $table->string('email')->nullable();
            $table->string('site')->nullable();
            $table->string('representante_nome')->nullable();
            $table->string('representante_cargo')->nullable();
            $table->string('autorizacao_funcionamento_em')->nullable();
            $table->string('concessao_registro_definitivo_em')->nullable();
            $table->string('registrada_em')->nullable();
            $table->string('classificacao_sigla')->nullable();
            $table->string('classificacao_nome')->nullable();
            $table->string('segmentacao_sigla')->nullable();
            $table->string('segmentacao_nome')->nullable();
            $table->string('endereco_logradouro')->nullable();
            $table->string('endereco_numero')->nullable();
            $table->string('endereco_complemento')->nullable();
            $table->string('endereco_bairro')->nullable();
            $table->string('endereco_cep')->nullable();
            $table->string('endereco_municipio_codigo')->nullable();
            $table->string('endereco_municipio_nome')->nullable();
            $table->string('endereco_uf_sigla')->nullable();
            $table->string('endereco_valido')->nullable();
            $table->string('telefone_ddd')->nullable();
            $table->string('telefone_numero')->nullable();
            $table->string('fax_ddd')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operadora');
    }
};

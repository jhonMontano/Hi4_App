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
        Schema::create('comentario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('contenido_comentario',255);
            $table->integer('id_usuarios');
            $table->integer('id_publicacion');
            $table->timestamps();
            $table->foreach('id_usuario')->reference('id')->on('usuarios');
            $table->foreach('id_publicacion')->reference('id')->on('publicacion');
            $table->foreach('id_')->reference('id')->on('comentario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentario');
    }
};

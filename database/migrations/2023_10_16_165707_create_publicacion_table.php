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
        Schema::create('publicacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->srting('contenido',255);
            $table->integer('id_usuario');   
            $table->timestamps();
            $table->foreach('id_usuario')->reference('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicacion');
    }
};

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
        Schema::create('me_gustas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_usuarios');
            $table->integer('id_publicacion');
            $table->timestamps();
            $table->foreach('id_publicacion')->reference('id')->on('publicacion');
            $table->foreach('id_usuario')->reference('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('me_gustas');
    }
};

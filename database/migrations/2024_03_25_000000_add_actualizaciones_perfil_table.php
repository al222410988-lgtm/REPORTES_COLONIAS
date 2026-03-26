<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('actualizaciones_perfil', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('usuarios')->onDelete('cascade');
            $table->string('campo_actualizado', 50); // email o password
            $table->timestamp('fecha_actualizacion');
            $table->timestamps();
            
            $table->index(['user_id', 'campo_actualizado', 'fecha_actualizacion'], 'actualizaciones_perfil_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('actualizaciones_perfil');
    }
};

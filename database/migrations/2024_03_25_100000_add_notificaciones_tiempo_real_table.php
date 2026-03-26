<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('notificaciones_tiempo_real', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('usuarios')->onDelete('cascade');
            $table->string('titulo');
            $table->text('mensaje');
            $table->string('tipo'); // info, warning, success, error, urgent
            $table->string('categoria'); // reporte, apoyo, sistema, administrativo
            $table->json('datos_adicionales')->nullable(); // ID del reporte, etc.
            $table->boolean('leida')->default(false);
            $table->timestamp('fecha_leida')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'leida', 'created_at'], 'notificaciones_user_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('notificaciones_tiempo_real');
    }
};

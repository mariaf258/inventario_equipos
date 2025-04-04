<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string('serial')->unique();
            $table->string('ip')->nullable();
            $table->string('tipo');
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->enum('estado', ['activo', 'inactivo', 'en_mantenimiento'])->default('activo');
            $table->foreignId('ubicacion_id')->constrained('ubicaciones')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
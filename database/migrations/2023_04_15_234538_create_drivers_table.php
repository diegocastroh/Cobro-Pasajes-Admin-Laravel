<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('dni');
            $table->string('password');

            $table->unsignedBigInteger('tipo_seguro_id')->nullable();
            $table->foreign('tipo_seguro_id')
            ->references('id')
            ->on('insurances')
            ->onDelete('set null')
            ->onUpdate('cascade');

            $table->string('tipo_licencia');
            $table->string('licencia_conducir');
            $table->date('fecha_vencimiento_licencia');

            $table->time('hora_ingreso');
            $table->time('hora_salida');
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};

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
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('placa');

            $table->unsignedBigInteger('chofer_id')->unique()->nullable();
            $table->foreign('chofer_id')
                ->references('id')
                ->on('drivers')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('ruta_id')->nullable();
            $table->foreign('ruta_id')
                ->references('id')
                ->on('routes')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->integer('capacidad_pasajeros');
            $table->string('modelo');
            $table->string('marca');
            $table->date('fecha_registro');
            $table->date('fecha_vencimiento_revision_tecnica');
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};

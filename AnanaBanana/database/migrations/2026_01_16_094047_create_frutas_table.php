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
        Schema::create('frutas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre', 100)->nullable(false);
            $table->date('fecha_recoleccion');
            $table->date('fecha_caducidad');
            $table->enum('conservacion', ['Frio', 'Ambiente']);
            $table->string('origen')->nullable(false);
            $table->decimal('kg_totales',12,2);
            $table->decimal('precio_kg',12,2);
            $table->foreignId('proveedor_id')->constrained('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frutas');
    }
};

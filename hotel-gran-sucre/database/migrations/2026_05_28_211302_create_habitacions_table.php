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
    Schema::create('habitacions', function (Blueprint $table) {
        $table->string('codHabitacion', 20)->primary(); 
        $table->string('tipo', 50);
        $table->integer('capacidad');
        $table->double('tarifa');
        $table->boolean('disponible')->default(true);
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('habitacions'); 
    Schema::dropIfExists('password_reset_tokens');
    Schema::dropIfExists('sessions');
}
};

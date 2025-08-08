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
        $preguntas = 'preguntas_cuestionario';
        Schema::create($preguntas, function (Blueprint $table) {
            $table->id();
            $table->string('pregunta');
            $table->bigInteger('cuestionario_id')->unsigned();
            $table->foreign('cuestionario_id')->references('id')->on('cuestionario_cursos')->onDelete('cascade')->onUpdate('cascade');
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

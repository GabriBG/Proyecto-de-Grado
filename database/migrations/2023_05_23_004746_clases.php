<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grupoasignado_id');
            $table->foreign('grupoasignado_id')->references('id')->on('asignacion_grupos')->onDelete('cascade');
            $table->unsignedBigInteger('horario_id');
            $table->foreign('horario_id')->references('id')->on('horarios')->onDelete('cascade');
            $table->unsignedBigInteger('aula_id');
            $table->foreign('aula_id')->references('id')->on('aulas')->onDelete('cascade');
            $table->string('modalidad')->notnull();
            $table->date('fecha')->notnull();
            $table->string('asistencia')->notnull();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunoCursosTable extends Migration
{
    public function up()
    {
        Schema::create('alunos_cursos', function (Blueprint $table) {
            $table->bigInteger('id_curso')->unsigned();
            $table->foreign('id_curso')->references('id')->on('cursos')->onDelete('cascade');

            $table->bigInteger('id_aluno')->unsigned();
            $table->foreign('id_aluno')->references('id')->on('alunos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cursos_alunos');
    }
}

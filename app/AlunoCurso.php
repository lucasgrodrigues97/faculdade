<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlunoCurso extends Model
{
    protected $table = 'alunos_cursos';
    protected $fillable = ['id_aluno', 'id_curso'];
    public $timestamps = false;
}

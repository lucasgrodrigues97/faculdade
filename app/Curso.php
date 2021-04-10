<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'cursos';
    protected $fillable = ['nome'];
    public $timestamps = false;

    public function alunos()
    {
        return $this->belongsToMany(Aluno::class, 'alunos_cursos', 'id_curso', 'id_aluno');
    }
}

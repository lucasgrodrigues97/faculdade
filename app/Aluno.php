<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Aluno extends Model
{
    protected $table = 'alunos';
    protected $fillable = ['nome', 'turma', 'curso', 'foto', 'endereco', 'data_matricula'];
    public $timestamps = false;

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'alunos_cursos', 'id_aluno', 'id_curso');
    }

    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return Storage::url($this->foto);
        }

        return Storage::url('/aluno/sem-imagem.jpg');
    }

}

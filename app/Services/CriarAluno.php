<?php

namespace App\Services;

use App\Aluno;
use App\AlunoCurso;
use App\Curso;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CriarAluno
{
    public function criarAluno(string $alunoNome, int $turmaAluno, string $cursoAluno, ?string $foto, string $endereco)
    {

        $date = Carbon::now('America/Sao_Paulo');
        DB::beginTransaction();
            $aluno = Aluno::create([
                'nome' => $alunoNome,
                'turma' => $turmaAluno,
                'curso' => $cursoAluno,
                'foto' => $foto,
                'endereco' => $endereco,
                'data_matricula' => $date->toDateTimeString()
            ]);

            $curso = Curso::query()->where('nome', $cursoAluno)->first();
            AlunoCurso::create([
                'id_aluno' => $aluno->id,
                'id_curso' => $curso->id
            ]);
        DB::commit();

        return $aluno;

    }
}

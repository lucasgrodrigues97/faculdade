<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Http\Requests\CursosFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CursosController extends Controller
{
    public function index(Request $request)
    {
        $cursos = Curso::query()->orderBy('nome')->get();
        $mensagem = $request->session()->get('mensagem');
        $request->session()->remove('mensagem');
        return view('cursos.index', compact('cursos', 'mensagem'));
    }

    public function create()
    {
        return view('cursos.create');
    }

    public function store(CursosFormRequest $request)
    {
        $existe = Curso::query()->where('nome', $request->nome)->count();
        if ($existe === 0) {
            DB::beginTransaction();
                $curso = Curso::create(['nome' => $request->nome]);
            DB::commit();
            $request->session()->flash('mensagem', "Curso {$curso->nome} inserido com sucesso. ID: {$curso->id}");
            return redirect('/cursos');
        }

        return redirect()->back()->withErrors('Já existe esse curso');

    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
            $curso = Curso::find($request->cursoId);
            $nomeCurso = $curso->nome;
            $curso->delete();
        DB::commit();
        $request->session()->flash('mensagem', "Curso {$nomeCurso} excluído com sucesso.");
        return redirect('/cursos');
    }

    public function editarNome(Request $request)
    {
        DB::beginTransaction();
            $novoNome = $request->nome;
            $curso = Curso::find($request->cursoId);
            $curso->nome = $novoNome;
            $curso->save();
        DB::commit();
    }

    public function indexPesquisar()
    {
        return view('cursos.pesquisar');
    }

    public function pesquisar(Request $request)
    {
        $curso = Curso::find($request->id);
        if (is_null($curso)) {
            return redirect()->back()->withErrors('Não existe esse curso');
        }

        $alunos = $curso->alunos;
        return view('cursos.pesquisar', compact('curso', 'alunos'));
    }
}

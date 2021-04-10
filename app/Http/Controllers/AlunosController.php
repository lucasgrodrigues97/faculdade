<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\AlunoCurso;
use App\Curso;
use App\Http\Requests\AlunosFormRequest;
use App\Services\CriarAluno;
use App\Services\GerarEndereco;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlunosController extends Controller
{
    public function index(Request $request)
    {
        $alunos = Aluno::query()->orderBy('nome')->paginate(3);
        $mensagem = $request->session()->get('mensagem');
        $mensagem2 = $request->session()->get('mensagem2');
        $request->session()->remove('mensagem');
        $request->session()->remove('mensagem2');
        return view('alunos.index', compact('alunos', 'mensagem', 'mensagem2'));
    }

    public function create()
    {
        return view('alunos.create');
    }

    public function store(AlunosFormRequest $request, CriarAluno $criarAluno)
    {
        $existeCurso = Curso::query()->where('nome', $request->curso)->count();
        $alunoPertenceAoCurso = Aluno::query()->where('nome', $request->nome)->where('curso', $request->curso)->count();

        if ($existeCurso == false || $alunoPertenceAoCurso == true) {
            return redirect()->back()->withErrors('Aluno já cadastrado nesse curso ou curso inexistente');
        }

        //para verificar se o campo foto foi preenchido
        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('aluno');
        }

        $cep = $request->cep;
        //validando o CEP
        if (! preg_match('/^[0-9]{5}-?[0-9]{3}$/', $cep)) {
            return redirect()->back()->withErrors('CEP inválido');
        }

        //consumindo de uma API o endereço através do CEP
        $url = "https://viacep.com.br/ws/$cep/json/";
        $end = json_decode(file_get_contents($url));
        if (! isset($end->logradouro)) {
            return redirect()->back()->withErrors('CEP inexistente');
        }

        //construindo o endereco
        $endereco =  $end->logradouro . ', ' . $end->bairro . ', ' . $end->localidade .  ': ' . $end->uf;

        $aluno = $criarAluno->criarAluno($request->nome, $request->turma, $request->curso, $foto, $endereco);
        $request->session()->flash('mensagem', "Aluna(o) {$aluno->nome} inserido com sucesso. ID: {$aluno->id}");
        return redirect('/alunos');
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
            $aluno = Aluno::find($request->alunoId);
            $nomeAluno = $aluno->nome;
            $aluno->delete();
        DB::commit();
        $request->session()->flash('mensagem', "Aluno {$nomeAluno} excluído com sucesso.");
        return redirect('/alunos');
    }

    public function editarAluno(Request $request)
    {
        DB::beginTransaction();
            $aluno = Aluno::find($request->alunoId);
            $aluno->nome = $request->nome;

            //para verificar se o novo curso existe no banco de dados
            $existeCurso = Curso::query()->where('nome', $request->curso)->count();
            if ($existeCurso == true) {
                $aluno->curso = $request->curso;
            } else {
                $request->session()->flash('mensagem2', "Curso não foi alterado, digite um curso existente");
            }
            $aluno->turma = $request->turma;
            $aluno->endereco = $request->endereco;

            //para verificar se o campo foto foi preenchido
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto')->store('aluno');
                $aluno->foto = $foto;
            }

            $aluno->save();
        DB::commit();
        $request->session()->flash('mensagem', "Dados do aluno alterados com sucesso");
    }

    public function indexPesquisar()
    {
        return view('alunos.pesquisar');
    }

    public function pesquisar(Request $request)
    {
        $aluno = Aluno::find($request->id);
        if (is_null($aluno)) {
            return redirect()->back()->withErrors('Não existe esse aluno');
        }
        return view('alunos.pesquisar', compact('aluno'));
    }

    public function situacao(Request $request)
    {
        $aluno = Aluno::find($request->alunoId);
        $mensagem = $request->session()->get('mensagem');
        $request->session()->remove('mensagem');
        return view('alunos.situacao', compact('aluno', 'mensagem'));
    }

    public function inativarSituacao(Request $request)
    {
        DB::beginTransaction();
            $aluno = Aluno::find($request->alunoId);
            $aluno->situacao = false;
            $aluno->save();
            $request->session()->flash('mensagem', "Situação alterada com sucesso");
        DB::commit();
        return redirect("/alunos/situacao/$aluno->id");
    }

    public function ativarSituacao(Request $request)
    {
        DB::beginTransaction();
            $aluno = Aluno::find($request->alunoId);
            $aluno->situacao = true;
            $aluno->save();
            $request->session()->flash('mensagem', "Situação alterada com sucesso");
        DB::commit();
        return redirect("/alunos/situacao/$aluno->id");
    }

}

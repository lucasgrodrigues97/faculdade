@extends('layout')

@section('cabecalho')
    Alterar situação do aluno
@endsection

@section('conteudo')
    @include('mensagem', ['mensagem' => $mensagem])

    <form method="post" action="/alunos/situacao/{{$aluno->id}}/{{$aluno->situacao == true ? 'inativar' : 'ativar'}}" onsubmit="return confirm('Tem certeza?')">
        @csrf
        <ul class="list-group">
            <li class="list-group-item align-items-center">
                <a href="{{$aluno->foto_url}}" target="_blank">
                    <img src="{{$aluno->foto_url}}" class="img-thumbnail mr-2" width="100px" height="100px">
                </a><br>
                ID: {{$aluno->id}}<br>
                Nome: {{$aluno->nome}}<br>
                Curso: {{$aluno->curso}}<br>
                Turma: {{$aluno->turma}}<br>
                Endereço: {{$aluno->endereco}}<br>
                Data de matrícula: {{ \Carbon\Carbon::parse($aluno->data_matricula)->format('d/m/Y')}}<br>
                Situação: <b>{{$aluno->situacao == true ? 'Ativo' : 'Inativo'}}</b><br><br>
                Clique aqui para alterar: <button class="btn btn-sm btn-outline-info">{{$aluno->situacao == true ? 'Inativar' : 'Ativar'}}</button>
            </li>
        </ul>
    </form>
    <hr>

@endsection

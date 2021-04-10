@extends('pesquisar')

@section('titulo')
    aluno
@endsection

@section('entidade')
    aluno:
@endsection

@section('corpo')

    @if(isset($aluno))
        <ul class="list-group">
            <li class="list-group-item align-items-center">
                <a href="{{$aluno->foto_url}}" target="_blank">
                    <img src="{{$aluno->foto_url}}" class="img-thumbnail" width="100px" height="100px">
                </a><br>
                ID: {{$aluno->id}}<br>
                Nome: {{$aluno->nome}}<br>
                Curso: {{$aluno->curso}}<br>
                Turma: {{$aluno->turma}}<br>
                Endereço: {{$aluno->endereco}}<br>
                Data de matrícula: {{ \Carbon\Carbon::parse($aluno->data_matricula)->format('d/m/Y')}}<br>
                Situação: {{$aluno->situacao == true ? 'Ativo' : 'Inativo'}} (<a href="/alunos/situacao/{{$aluno->id}}">Alterar</a>)
            </li>
        </ul>
    @endif
@endsection


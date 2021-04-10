@extends('pesquisar')

@section('titulo')
     curso
@endsection

@section('entidade')
     curso:
@endsection

@section('corpo')

    @if(isset($curso))
        <ul class="list-group">
            <li class="list-group-item align-items-center">
                ID: {{$curso->id}}<br>
                Nome: {{$curso->nome}}<br><hr>
                <b>Alunos do curso:</b>
                @foreach($alunos as $aluno)
                    <br>{{$aluno->nome}}
                @endforeach
            </li>
        </ul>
    @endif
@endsection

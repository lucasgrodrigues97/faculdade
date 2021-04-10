@extends('layout')

@section('cabecalho')
    Alunos
@endsection

@section('conteudo')

    <script src="js/editarAluno.js"></script>

        @include('mensagem', ['mensagem' => $mensagem, 'mensagem2' => $mensagem2])


            @auth
                <div class=" d-flex justify-content-between">
                    <a href="/alunos/criar" class="btn btn-outline-primary mb-2">
                        Adicionar aluno
                    </a>
                    <a href="/alunos/pesquisar" class="btn btn-outline-dark mb-2">
                        Pesquisar aluno
                    </a>
                </div>
            @endauth

            <ul class="list-group">
                @foreach ($alunos as $aluno)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <span id="atual-aluno-{{$aluno->id}}">
                                <a href="{{$aluno->foto_url}}" target="_blank">
                                    <img src="{{$aluno->foto_url}}" class="img-thumbnail mr-2" width="100px" height="100px">
                                </a><br>
                                Nome: {{$aluno->nome}}<br>
                                Curso: {{$aluno->curso}}<br>
                                Turma: {{$aluno->turma}}<br>
                                <span>Endereço: {{$aluno->endereco}}</span><br>
                                Data de matrícula: {{ \Carbon\Carbon::parse($aluno->data_matricula)->format('d/m/Y')}}<br>
                                Situação: {{$aluno->situacao == true ? 'Ativo' : 'Inativo'}} (<a href="/alunos/situacao/{{$aluno->id}}">Alterar</a>)
                            </span>
                            <br>
                        </div>

                        <div class="mr-2 w-100" hidden id="atualizar-aluno-{{$aluno->id}}">
                            <input id="aluno-foto" type="file" class="form-control mt-1">
                            <input id="aluno-nome" type="text" class="form-control mt-1" value="{{$aluno->nome}}">
                            <input id="aluno-curso" type="text" class="form-control mt-1" value="{{$aluno->curso}}">
                            <input id="aluno-turma" type="text" class="form-control mt-1" value="{{$aluno->turma}}">
                            <input id="aluno-endereco" type="text" class="form-control mt-1" value="{{$aluno->endereco}}">

                            <div class="input-group-append justify-content-end mt-1">
                                <button class="btn btn-sm btn-primary" onclick="editarAluno({{$aluno->id}})">
                                    <i class="fas fa-check"></i>
                                </button>
                                @csrf
                            </div>
                        </div>
                        <span class="d-flex">

                            @auth
                                <button class="btn btn-info btn-sm mr-2" onclick="toggleInput({{$aluno->id}})">
                                    <i class="fas fa-edit"></i>
                                </button>
                            @endauth

                            @auth
                                <form method="post" action="/alunos/{{$aluno->id}}" onsubmit="return confirm('Tem certeza?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            @endauth

                        </span>
                    </li>
                @endforeach
            </ul>
            <div class="mt-2 d-flex justify-content-end">{{$alunos->links()}}</div>


@endsection


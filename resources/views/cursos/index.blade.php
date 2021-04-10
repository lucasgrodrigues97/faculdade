@extends('layout')

@section('cabecalho')
    Cursos
@endsection

@section('conteudo')
    <script src="js/editarCurso.js"></script>

        @include('mensagem', ['mensagem' => $mensagem])

            @auth
            <div class=" d-flex justify-content-between">
                <a href="/cursos/criar" class="btn btn-outline-primary mb-2">
                    Adicionar curso
                </a>
                <a href="/cursos/pesquisar" class="btn btn-outline-dark mb-2">
                    Pesquisar curso
                </a>
            </div>
            @endauth

            <ul class="list-group">
                @foreach ($cursos as $curso)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <span id="atual-curso-{{$curso->id}}">{{$curso->nome}}</span>
                        </div>

                        <div class="mr-2 input-group w-100" hidden id="atualizar-curso-{{$curso->id}}">
                            <input id="curso-nome" type="text" class="form-control" value="{{$curso->nome}}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" onclick="editarCurso({{$curso->id}})">
                                    <i class="fas fa-check"></i>
                                </button>
                                @csrf
                            </div>
                        </div>

                        <span class="d-flex">

                            @auth
                            <button class="btn btn-info btn-sm mr-2" onclick="toggleInput({{$curso->id}})">
                                <i class="fas fa-edit"></i>
                            </button>
                            @endauth

                            @auth
                            <form method="post" action="/cursos/{{$curso->id}}" onsubmit="return confirm('Tem certeza?')">
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
@endsection


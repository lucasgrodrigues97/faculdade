@extends('layout')

@section('cabecalho')
    Adicionar aluno
@endsection

@section('conteudo')

        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mt-2">
                <div class="col col-6">
                    <label for="nome" class="">Nome do aluno</label>
                    <input type="text" class="form-control" name="nome" id="nome">
                </div>
                <div class="col col-3">
                    <label for="nome" class="">Curso do aluno</label>
                    <input type="text" class="form-control" name="curso" id="nome">
                </div>
                <div class="col col-3">
                    <label for="nome" class="">Turma do aluno</label>
                    <input type="text" class="form-control" name="turma" id="nome">
                </div>
                <div class="col col-12 mt-1">
                    <label for="foto" class="">Foto do aluno</label>
                    <input type="file" class="form-control" name="foto" id="foto">
                </div>
                <div class="col col-12 mt-1">
                    <label for="cep" class="">CEP do aluno</label>
                    <input type="text" class="form-control" name="cep" id="cep">
                </div>

            </div>

            <button class="btn btn-outline-primary mt-3">Adicionar</button>
        </form>
        @include('errors', ['errors' => $errors])
@endsection

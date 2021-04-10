@extends('layout')


@section('cabecalho')
    Adicionar curso
@endsection

@section('conteudo')


        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mt-2">
                <div class="col col-12">
                    <label for="nome" class="">Nome do curso</label>
                    <input type="text" class="form-control" name="nome" id="nome">
                </div>
            </div>
            <button class="btn btn-outline-primary mt-2">Adicionar</button>
        </form>
        @include('errors', ['errors' => $errors])
@endsection

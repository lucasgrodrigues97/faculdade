@extends('layout')

@section('cabecalho')
    Alterar situação do aluno
    <script src="js/xmlToJ.js"></script>
@endsection

@section('conteudo')

    <div id="lista">
        <div class="row">
            <div class="col">
                <h4>Cursos XML</h4>
                <hr />


                    @csrf
                    <button class="btn btn-outline-info btn-sm" onclick="getFilmes()">
                        Listar cursos
                    </button>


            </div>
        </div>
        <div class="row mt-3">
            <div class="col">

            </div>
        </div>
    </div>

@endsection

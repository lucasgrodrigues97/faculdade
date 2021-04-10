@extends('layout')

@section('cabecalho')
    Início
@endsection

@section('conteudo')
    <div class="row">

        <div class="card-home">
            <div class="card">
                <div class="card-header">
                    Menu
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 d-flex justify-content-center">
                            <h5><a href="/cursos" class="link">Tela de Cursos</a></h5>
                        </div>
                        <div class="col-4 d-flex justify-content-center">
                            <h5><a href="/alunos">Tela de Alunos</a></h5>
                        </div>
                        <div class="col-4 d-flex justify-content-center">
                            <h5><a href="/xml">Cursos em XML</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

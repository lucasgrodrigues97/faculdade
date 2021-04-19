<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/entrar');
});

Route::get('/entrar', 'EntrarController@index');
Route::post('/entrar', 'EntrarController@entrar');
Route::get('/sair', function () {
   \Illuminate\Support\Facades\Auth::logout();
   return redirect('/entrar');
});
Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@store');
Route::get('/inicio', 'InicioController@index')->middleware('autenticador');;

Route::get('/cursos', 'CursosController@index')->middleware('autenticador');;
Route::get('/cursos/criar', 'CursosController@create')->middleware('autenticador');
Route::post('/cursos/criar', 'CursosController@store')->middleware('autenticador');
Route::delete('/cursos/{cursoId}', 'CursosController@destroy')->middleware('autenticador');
Route::post('/cursos/{cursoId}/editarNome', 'CursosController@editarNome')->middleware('autenticador');
Route::get('/cursos/pesquisar', 'CursosController@indexPesquisar')->middleware('autenticador');
Route::post('/cursos/pesquisar', 'CursosController@pesquisar')->middleware('autenticador');

Route::get('/alunos', 'AlunosController@index')->middleware('autenticador');;
Route::get('/alunos/criar', 'AlunosController@create')->middleware('autenticador');
Route::post('/alunos/criar', 'AlunosController@store')->middleware('autenticador');
Route::delete('/alunos/{alunoId}', 'AlunosController@destroy')->middleware('autenticador');
Route::post('/alunos/{alunoId}/editarAluno', 'AlunosController@editarAluno')->middleware('autenticador');
Route::get('/alunos/pesquisar', 'AlunosController@indexPesquisar')->middleware('autenticador');
Route::post('/alunos/pesquisar', 'AlunosController@pesquisar')->middleware('autenticador');
Route::get('/alunos/situacao/{alunoId}', 'AlunosController@situacao')->middleware('autenticador');
Route::post('/alunos/situacao/{alunoId}/inativar', 'AlunosController@inativarSituacao')->middleware('autenticador');
Route::post('/alunos/situacao/{alunoId}/ativar', 'AlunosController@ativarSituacao')->middleware('autenticador');




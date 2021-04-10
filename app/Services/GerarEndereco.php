<?php

namespace App\Services;

use http\Env\Request;

class GerarEndereco
{
    public function gerarEndereco($cep)
    {
        if (! preg_match('/^[0-9]{8}$/', $cep)) {
            return redirect('/alunos/criar')->withErrors('CEP inválido');
        }

        $url = "https://serviceweb.aix.com.br/aixapi/api/cep/$cep";
        $end = json_decode(file_get_contents($url));
        if (! isset($end->logradouro)) {
            return redirect('/alunos/criar')->withErrors('CEP inexistente');
        }

        $endereco =  $end->logradouro . ', ' . $end->bairro . ', ' . $end->cidade .  ': ' . $end->estado;
        return $endereco;
    }
}

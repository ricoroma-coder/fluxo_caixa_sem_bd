<?php

function pegarDadosArquivo($caminho) {
    $delimitador = ';';
    $caminho = __DIR__ . "/../1-fluxos/{$caminho}";
    $planilha = fopen($caminho, 'r');

    if ($planilha === false)
        return false;

    $personalizado = substr($caminho, -4) != '.csv';
    if ($planilha) {
        $cabecalho = fgetcsv($planilha, 0, $delimitador);
        $subcabecalho = [];
        $linhas = [];
        while (!feof($planilha)) {
            $linha = fgetcsv($planilha, 0, $delimitador);
            if (!$linha)
                continue;

            if (empty($subcabecalho))
                $subcabecalho = $linha;
            else
                $linhas[] = $linha;
        }
        fclose($planilha);
    }

    return [
        'cabecalho' => $cabecalho, 
        'subcabecalho' => $subcabecalho, 
        'linhas' => $linhas, 
        'personalizado' => $personalizado
    ];
}

function calcularValores($arquivo) {
    $totais = array_fill(0, 9, 0);
    $tabelas = array_fill_keys([0,1,2,3,4,5,6,7,8], []);
    $posicoesValores = [];

    foreach ($arquivo['subcabecalho'] as $posicaoCabecalho => $subcabecalhos) {
        foreach (explode('|', $subcabecalhos) as $posicaoSubcabecalho => $subcabecalho) {
            if ($subcabecalho == "valor")
                $posicoesValores[$posicaoCabecalho] = $posicaoSubcabecalho;
        }
    }
    
    foreach ($arquivo['linhas'] as $linha) {
        foreach ($linha as $posicaoCabecalho =>  $valores) {
            $tabelas[$posicaoCabecalho][] = $valores;
            foreach (explode('|', $valores) as $posicaoValor => $valor) {
                if ($posicaoValor == $posicoesValores[$posicaoCabecalho]) {
                    $valor = str_replace(',', '.', $valor);
                    if (isset($totais[$posicaoCabecalho]) && !empty($totais[$posicaoCabecalho]))
                        $valor += $totais[$posicaoCabecalho];
                    $totais[$posicaoCabecalho] = $valor;
                }
            }
        }
        
    }

    return ['individual' => $tabelas, 'conjunto' => $totais];
}

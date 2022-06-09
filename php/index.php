<?php

function limparArray($array) {
    unset($array[0]);
    unset($array[1]);

    return $array;
}

function organizarPastas($fluxos) {
    $fluxos = limparArray($fluxos);
    $array = [];

    foreach ($fluxos as $ano) {
        $arquivos = limparArray(scandir("1-fluxos/{$ano}"));
        $array[$ano] = [];

        foreach ($arquivos as $arquivo) {
            if (substr($arquivo, -4) == ".csv")
                $array[$ano][] = str_replace(".csv", "", $arquivo);
        }
    }

    return $array;
}

function checarDataRecentes($caminho_arq, &$ultimos) {
    $ultimos[] = ["nome" => $caminho_arq, "data" => filemtime("1-fluxos/{$caminho_arq}")];
}

function ordenarRecentes($recentes) {
    $auxiliar = [];

    foreach ($recentes as $chave => $arquivo) {
        $auxiliar[$chave] = $arquivo['data'];
    }

    $copia_auxiliar = $auxiliar;
    rsort($copia_auxiliar);
    $retorno = [];

    foreach ($copia_auxiliar as $data) {
        $chave = array_search($data, $auxiliar);
        $retorno[] = $recentes[$chave];
    }

    return array_slice($retorno, 0, 5);
}

<?php

if (isset($_POST) && !empty($_POST)) {
    $header = [
        [
            'saidas',
            'entradas',
            'dividendos',
            'combustivel',
            'compras',
            'gastos_extras',
            'transferencias',
            'investimentos',
            'resultado'
        ]
    ];
    $meses = ["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"];
    $pastas = scandir('../1-fluxos');

    if (!$pastas) {
        mkdir("../1-fluxos");
        $pastas = ['.','..'];
    }

    if (isset($_POST['auto'])) {
        if (sizeof($pastas) <= 2) {
            $ano = date("Y");
            $mes = "Janeiro";
            mkdir("../1-fluxos/{$ano}");
        }
        else {
            unset($anos[0], $anos[1]);
            $pastas_filtradas = [];

            foreach ($pastas as $pasta) {
                if (preg_match("/^\\d+$/", $pasta))
                    $pastas_filtradas[] = $pasta;
            }

            rsort($pastas_filtradas);
            $ano = $pastas_filtradas[0];
            $scan_meses = scandir("../1-fluxos/{$ano}");

            if ($scan_meses !== false && array_search("Dezembro.csv", $scan_meses) !== false) {
                $ano++;
                mkdir("../1-fluxos/{$ano}");
                $mes = "Janeiro";
            } else {
                $contador = 10;
                $mes = "";

                while (empty($mes) && $contador >= 0) {
                    if (array_search("{$meses[$contador]}.csv", $scan_meses) !== false)
                        $mes = $meses[$contador+1];

                    if ($contador == 0 && empty($mes))
                        $mes = "Janeiro";
                    $contador--;
                }
            }
        }

        $caminhoArq = "../1-fluxos/{$ano}/{$mes}.csv";
    } else {
        $pasta = $_POST['folder'];
        $nomeAltPasta = $_POST['altDir'];
        $nomeArq = $_POST['name'];
        $nomeAltArq = $_POST['altName'];
        $pastas = scandir("../1-fluxos");

        if (isset($nomeAltPasta) && !empty($nomeAltPasta))
            $pasta = $nomeAltPasta;

        if (!in_array($pasta, $pastas))
            mkdir("../1-fluxos/{$pasta}");

        if (isset($nomeAltArq) && !empty($nomeAltArq))
            $nomeArq = $nomeAltArq;

        $caminhoArq = false;
        if (!in_array("{$nomeArq}.csv", scandir("../1-fluxos/{$pasta}")))
            $caminhoArq = "../1-fluxos/{$pasta}/{$nomeArq}.csv";
    }

    if ($caminhoArq !== false) {
        $csv = fopen($caminhoArq, "w");
        foreach ($header as $titulo) {
            fputcsv($csv, $titulo, ";");
        }
        fclose($csv);
    }
}

header("Location: ../criar.php");

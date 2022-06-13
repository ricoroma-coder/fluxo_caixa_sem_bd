<?php
    require_once __DIR__ . "/php/resumo.php";
    if (!isset($_GET['nome']) || empty($_GET['nome']))
        header('Location: index.php');

    $arquivo = pegarDadosArquivo($_GET['nome']);

    if ($arquivo === false || empty($arquivo['cabecalho']))
        header('Location: index.php');

    $valores = calcularValores($arquivo);
?>

<html style="min-height: 100vh;min-width: 100vw;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Fluxo de Caixa</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/telas/resumo.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/telas/resumo.js"></script>
    </head>
    <body>
        <header class="row bg-dark m-0 p-2 w-100">
            <div id="title" class="p-2 text-light font-weight-bold" style="font-size: 1.3rem;font-weight: bolder;">Fluxo de Caixa</div>
        </header>

        <section class="container">
            <div id="head-section" class="d-flex justify-content-end p-1 mt-3">
                <div>
                    <button class="btn btn-secondary rounded" style="font-size: 1.1rem;" onclick="window.location.href = '/';">Voltar</button>
                </div>
            </div>

            <hr/>

            <div id="content-section" class="d-flex p-2 mt-1 flex-wrap">
                <div class="d-flex justify-content-lg-between w-100 p-3">
                    <h3>Resumo</h3>
                    <h5><?php echo $_GET['nome']; ?></h5>
                </div>

                <div class="flex-1 p-3 w-50">
                    <table class="border border-1 w-100">
                        <thead>
                            <th class="text-center p-2 border border-1 bg-dark text-light" colspan="100%">Despesas</th>
                        </thead>
                        <tbody>
                            <?php
                                $despesas = [0, 3, 4, 5];

                                foreach ($despesas as $posicao) {
                            ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $arquivo['cabecalho'][$posicao]; ?></td>
                                    <td style="text-align: center;"><?php echo $valores['conjunto'][$posicao]; ?></td>
                                </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="flex-1 p-3 w-50">
                    <table class="border border-1 w-100">
                        <thead>
                            <th class="text-center p-2 border border-1 bg-dark text-light" colspan="100%">Receitas</th>
                        </thead>
                        <tbody>
                            <?php
                                $receitas = [1, 2, 7, 8];

                                foreach ($receitas as $posicao) {
                            ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $arquivo['cabecalho'][$posicao]; ?></td>
                                    <td style="text-align: center;"><?php echo $valores['conjunto'][$posicao]; ?></td>
                                </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div id="more-details-handler" class="d-flex flex-column justify-content-center align-content-center p-3 w-100">
                    <div id="detail-trigger" class="p-1 text-center" style="cursor: pointer;" onclick="gatilhoDetalhe(this);">Mais detalhes...</div>
                    <div id="detail-content" class="d-flex flex-wrap border border-1 overflow-hidden">
                        <?php
                            foreach ($valores['individual'] as $posicaoCabecalho => $linhas) {
                        ?>
                            <div class="w-100 p-5">
                                <table class="table text-center">
                                    <thead class="bg-dark text-light">
                                        <th class="p-1" colspan="100%"><?php echo $arquivo['cabecalho'][$posicaoCabecalho]; ?></th>
                                        <tr>
                                            <?php
                                                foreach (explode('|', $arquivo['subcabecalho'][$posicaoCabecalho]) as $subcabecalho) {
                                            ?>
                                                <td><?php echo $subcabecalho; ?></td>
                                            <?php
                                                }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($valores['individual'][$posicaoCabecalho] as $registros) {
                                        ?>
                                            <tr>
                                        <?php
                                                foreach (explode('|', $registros) as $valor) {
                                        ?>
                                                <td><?php echo $valor; ?></td>
                                        <?php
                                                }
                                        ?>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
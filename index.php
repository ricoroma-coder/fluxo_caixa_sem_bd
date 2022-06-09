<?php
    require_once __DIR__ . "/php/index.php";
?>

<html style="min-height: 100vh;min-width: 100vw;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Fluxo de Caixa</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/telas/index.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/telas/index.js"></script>
    </head>
    <body>
        <header class="row bg-dark m-0 p-2 w-100">
            <div id="title" class="p-2 text-light font-weight-bold" style="font-size: 1.3rem;font-weight: bolder;">Fluxo de Caixa</div>
        </header>

        <section class="container">
            <div id="head-section" class="d-flex justify-content-end p-1 mt-3">
                <div>
                    <button class="btn btn-success rounded" style="font-size: 1.1rem;" onclick="window.location.href = '/criar.php';">Criar</button>
                </div>

                <div style="margin-left: 5px;">
                    <button class="btn btn-danger rounded" style="font-size: 1.1rem;">Remover</button>
                </div>
            </div>

            <hr/>

            <div id="content-section" class="d-flex p-2 mt-1">
                <div class="flex-1 p-3 w-50">
                    <table class="border boder-1 w-100" id="tabListaFluxos">
                        <thead>
                            <th class="text-center p-2 border border-1 bg-dark text-light" scope="100%">Fluxos</th>
                        </thead>
                        <tbody>
                            <?php
                                $dir = scandir("1-fluxos");
                                if (!$dir || sizeof($dir) <= 2) {
                            ?>
                                <tr>
                                    <td>Nenhum fluxo encontrado...</td>
                                </tr>
                            <?php
                                }
                                else {
                                    $lista = organizarPastas($dir);
                                    $ultimos = [];
                                    foreach ($lista as $ano => $arquivos) {
                            ?>
                                <tr>
                                    <td>
                                        <div class="d-flex w-100" onclick="ativarListaArquivos($(this));">
                                            <div class="border border-1">
                                                <img src="imagens/ico_pasta.png" style="height: 50px;width: 40px;">
                                            </div>
                                            <div class="p-1 border border-1 w-100 d-flex align-items-center"><?php echo $ano; ?></div>
                                        </div>

                                        <?php
                                            foreach ($arquivos as $arquivo) {
                                                checarDataRecentes("{$ano}/{$arquivo}.csv", $ultimos);
                                        ?>
                                            <table class="w-100">
                                                <tr>
                                                    <td>
                                                        <div class="d-flex" style="margin-left: 42px; flex: 1;">
                                                            <div class="p-1 border border-1">
                                                                <img src="imagens/ico_arq.png" style="height: 30px;width: 30px;">
                                                            </div>
                                                            <div class="p-1 border border-1 w-100 d-flex align-items-center"><?php echo $arquivo; ?></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        <?php
                                            }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="flex-1 p-3 w-50">
                    <table class="border boder-1 w-100">
                        <thead>
                            <th class="text-center p-2 border border-1 bg-dark text-light" scope="2">Recentes</th>
                        </thead>
                        <tbody>
                            <?php
                                if (!is_null($ultimos)) {
                                    foreach (ordenarRecentes($ultimos) as $arquivo) {
                            ?>
                                <tr>
                                    <td>
                                        <div class="d-flex w-100 position-relative">
                                            <div class="border border-1">
                                                <img src="imagens/ico_arq.png" style="height: 50px;width: 50px;">
                                            </div>
                                            <div class="p-1 border border-1 w-100 d-flex align-items-center"><?php echo $arquivo['nome']; ?></div>
                                            <div class="position-absolute" style="bottom: 0;right: 0;font-size: 14px;"><?php echo date("d/m/Y H:i:s", substr($arquivo['data'], 0, 10)); ?></div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                    }
                                } else {
                            ?>
                                <tr>
                                    <td>Nenhum arquivo recente...</td>
                                </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </body>
</html>
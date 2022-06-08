<?php
    require_once __DIR__ . "/php/index.php";
?>

<html style="min-height: 100vh;min-width: 100vw;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Fluxo de Caixa - Criar</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/telas/criar.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/telas/criar.js"></script>
    </head>
    <body>
        <header class="row bg-dark m-0 p-2 w-100">
            <div id="title" class="p-2 text-light font-weight-bold" style="font-size: 1.3rem;font-weight: bolder;">Fluxo de Caixa</div>
        </header>

        <section class="container">
            <div id="head-section" class="d-flex justify-content-end p-1 mt-3">
                <div>
                    <button class="btn btn-success rounded" style="font-size: 1.1rem;" onclick="window.location.href = '/';">Voltar</button>
                </div>

                <div style="margin-left: 5px;">
                    <button class="btn btn-danger rounded" style="font-size: 1.1rem;">Editar</button>
                </div>
            </div>

            <hr/>

            <div id="content-section" class="d-flex p-2 mt-1">
                <div class="flex-1 p-3 w-100">
                    <form action="php/formulario_criar.php" method="post">
                        <div class="row m-0">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend" style="margin-right: 5px;">
                                    <div class="input-group-text">
                                        <input type="checkbox" aria-label="Cria uma nova planilha, baseando na última data." name="auto" onchange="trigarCheckboxCriar(this);">
                                    </div>
                                </div>
                                <h5 aria-label="Cria uma nova planilha, baseando na última data.">Criar automaticamente</h4>
                            </div>
                        </div>

                        <div class="container">
                            <h5 style="margin-left: 20px;">ou</h5>
                        </div>

                        <div id="content-form" class="mt-2">
                            <div class="row m-0 w-100">
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">Nome</label>
                                        </div>
                                        <select name="name" class="custom-select bg-white" id="inputGroupSelect01" style="flex: 1;">
                                            <option selected>Escolha...</option>
                                            <option value="1">Janeiro</option>
                                            <option value="2">Fevereiro</option>
                                            <option value="3">Março</option>
                                            <option value="4">Abril</option>
                                            <option value="5">Maio</option>
                                            <option value="6">Junho</option>
                                            <option value="7">Julho</option>
                                            <option value="8">Agosto</option>
                                            <option value="9">Setembro</option>
                                            <option value="10">Outubro</option>
                                            <option value="11">Novembro</option>
                                            <option value="12">Dezembro</option>
                                            <option value="13">Personalizado</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Sufixo do nome</span>
                                        </div>
                                        <input name="sufixName" type="text" class="form-control" placeholder="Digite aqui" aria-label="Sufixo do nome da planilha" aria-describedby="basic-addon1">
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect02">Pasta</label>
                                        </div>
                                        <select class="custom-select bg-white" id="inputGroupSelect02" style="flex: 1;">
                                            <option selected>Choose...</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Sufixo da pasta</span>
                                        </div>
                                        <input name="sufixDir" type="text" class="form-control" placeholder="Digite aqui" aria-label="Sufixo do nome da planilha" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end p-3">
                                <button class="btn btn-success">Criar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>
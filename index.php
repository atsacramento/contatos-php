<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html lang="en">

    <head>
        <?php
            session_start();

            include_once '_head.php';
            include_once 'conexao.php';

            $consulta = $conn->query("SELECT * FROM contatos");
        ?>
    </head>

    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="container">

            <div class="titulo">
                <span>Listagem de Contatos(s)</span>
                <span><i class='fas fa-users'></i></span>
            </div>
            <br>

            <?php
                include_once "_success.php";
                include_once "_error.php";
            ?>

            <div class="titulo-1">
                <button id="btNovo" type="button" class="btn btn-success" onClick="adicionar()">
                    <i class="fa fa-save"></i>&nbsp;Novo
                </button>
            </div>
            <div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th class="text-center" style="width: 10%" scope="col">CODIGO</th>
                        <th scope="col">NOME</th>
                        <th style="width: 13%" scope="col">TELEFONE</th>
                        <th style="width: 5%" scope="col">UF</th>
                        <th class="text-center" style="width: 10%" scope="col">AÇÃO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td class="text-center" scope="row"><?= str_pad($row["id"], 5, "0", STR_PAD_LEFT) ?></td>
                            <td><?= $row["nome"] ?></td>
                            <td><?= $row["telefone"] ?></td>
                            <td><?= $row["uf"] ?></td>
                            <td class="text-center">
                                <a class="icon icon-vermelho" data-toggle="modal" data-target="#exclusao" alt="excluir" title="Excluir" onclick="deleteSet('<?= $row['id'] ?>#<?= $row['nome'] ?>')">
                                    <i class='fas fa-trash-alt'></i>
                                </a>
                                <a class="icon icon-verde" alt="editar" title="Editar" onclick="alterar('<?= $row['id'] ?>')">
                                    <i class='far fa-edit '></i>
                                </a>
                                <a class="icon icon-azul" data-toggle="modal" data-target="#consulta" alt="consultar" title="Consultar" onclick="searchSet('<?= $row['nome'] ?>#<?= $row['endereco']?>#<?= $row['numero']?>#<?= $row['complemento']?>#<?= $row['cep']?>#<?= $row['uf']?>')">
                                    <i class='fas fa-search'></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Modal CONSULTA -->
        <div class="modal fade" id="consulta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Consulta Completa</h5>
                        <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-2">
                                <label for="nome">Nome</label>
                            </div>
                            <div class="col-10">
                                <input type="text" class="form-control" id="nome" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2">
                                <label for="endereco">Endereço</label>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" id="endereco" readonly>
                            </div>
                            <div class="col-2">
                                <label for="numero">Número</label>
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" id="numero" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2">
                                <label for="complemento">Outros</label>
                            </div>
                            <div class="col-10">
                                <input type="text" class="form-control" id="complemento" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2">
                                <label for="cep">Cep</label>
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control" id="cep" readonly>
                            </div>
                            <div class="col-1">
                                <label for="uf">UF</label>
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" id="uf" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Sair</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal EXCLUSAO -->
        <div class="modal fade" id="exclusao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Exclusão</h5>
                        <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="codigoClienteExcluido" value="">
                        Confirma à exclusão de(a) <span id="nomeClienteExcluido"></span> ?
                    </div>
                    <div class="modal-footer">
                        <form method="post" id="enviarFormDelete" action="crud_oper.php" >
                            <input type="hidden" name="action" value="E">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="deleteSubmit()"><i class='fas fa-check-double'></i> Sim</button>    
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> Não</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
            include_once "_script.php" 
        ?>
    </body>
</html>
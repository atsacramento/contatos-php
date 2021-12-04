<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html lang="en">

    <head>
        <?php 
            session_start();

            include_once '_head.php';
            include_once 'conexao.php';

            ####################################################################
            #INICIALIZAÇÃO DE VARIAVEIS
            ####################################################################
            $codigo = "";
            $nome = "";
            $endereco = "";
            $complemento = "";
            $numero = "";
            $cep = "";
            $uf ="";
            $telefone ="";
            
            ####################################################################
            # BUSCANDO OS DADOS PARA ALTERAÇÃO
            ####################################################################
            if(isset($_GET['id'])) {
                $consulta = $conn->query("SELECT * FROM contatos WHERE id=".$_GET['id']);
                $row = $consulta->fetch(PDO::FETCH_ASSOC);
                $codigo = $row['id'];
                $nome = $row["nome"];
                $endereco = $row["endereco"];
                $complemento = $row["complemento"];
                $numero = $row["numero"];
                $cep = $row["cep"];
                $uf = $row["uf"];
                $telefone = $row["telefone"];
            }
        ?>
    </head>

    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="container">
            <div class="titulo">
                <span>Cadastro de Contato(s)</span>
                <span><i class='fas fa-users'></i></span>
            </div>
            <br>

            <?php
                include_once "_error.php";
            ?>
            
            <form method="post" action="crud_oper.php">
                <input type="hidden" name="action" value="C">

                <div class="row">
                    <div class="col-1">
                        <label for="codigo">Código</label>
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control" name="codigo" value="<?= $codigo ?>" readonly>
                    </div>
                    <div class="col-1">
                        <label for="nome">Nome</label>
                    </div>
                    <div class="col-8">
                        <input type="text" class="form-control" name="nome" maxlength="255"  value="<?= $nome ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-1">
                        <label for="endereco">Endereço</label>
                    </div>
                    <div class="col-8">
                        <input type="text" class="form-control" name="endereco" maxlength="255" value="<?= $endereco ?>">
                    </div>
                    <div class="col-1">
                        <label for="numero">Número</label>
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control" name="numero" maxlength="10" value="<?= $numero ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-1">
                        <label for="complemento">Complemento</label>
                    </div>
                    <div class="col-4">
                        <input type="text" class="form-control" name="complemento" maxlength="255" value="<?= $complemento ?>">
                    </div>
                    <div class="col-1 text-right">
                        <label for="cep">Cep</label>
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control" name="cep" maxlength="8" value="<?= $cep ?>">
                    </div>
                    <div class="col-1 text-right">
                        <label for="uf">Uf</label>
                    </div>
                    <div class="col-3">
                        <select class="form-control" name="uf" value="<?= $uf ?>">
                            <option value="" <?php echo $uf=='' ? 'selected' : '';?>>--- Selecione ---</option>
                            <option value="RJ" <?php echo $uf=='RJ' ? 'selected' : '';?>>Rio de Janeiro</option>
                            <option value="SP" <?php echo $uf=='SP' ? 'selected' : '';?>>São Paulo</option>
                            <option value="MG" <?php echo $uf=='MG' ? 'selected' : '';?>>Minas Gerais</option>
                            <option value="RS" <?php echo $uf=='RS' ? 'selected' : '';?>>Rio Grande do Sul</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1">
                        <label for="telefone">Telefone</label>
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control" name="telefone" maxlength="14" value="<?= $telefone ?>">
                    </div>
                </div>

                <br>
                
                <div class="row botoes">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i>&nbsp;Salvar
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-danger" onclick="document.location.href='index.php'">
                        <i class='far fa-list-alt'></i> Listagem
                    </button>
                </div>
            </form>
          </div>

        <?php include_once "_script.php" ?>
        <script src="" async defer></script>
    </body>
</html>
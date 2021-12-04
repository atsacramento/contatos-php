<?php
    session_start();

    include_once 'conexao.php';

    // RECUPERAÇÂO DOS DADOS DO FORM
    $operacao = isset($_POST["action"]) ? $_POST["action"] : "";
    $codigo = isset($_POST["codigo"]) ? $_POST["codigo"] : "";
    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
    $endereco = isset($_POST["endereco"]) ? $_POST["endereco"] : "";
    $complemento = isset($_POST["complemento"]) ? $_POST["complemento"] : "";
    $numero = isset($_POST["numero"]) ? $_POST["numero"] : "";
    $cep = isset($_POST["cep"]) ? $_POST["cep"] : "";
    $uf = isset($_POST["uf"]) ? $_POST["uf"] : "";
    $telefone = isset($_POST["telefone"]) ? $_POST["telefone"] : "";


    $viewsucess = "index.php";
    $viewerror = $operacao == "C" ? "crud_view.php" : $viewsucess;


    try {
        ###################################################
        # INCLUSAO OU ALTERAÇÂO
        ###################################################
        if($operacao == "C") {
            if ($codigo == "") {
                $sql="INSERT INTO contatos (nome,endereco,complemento,numero,cep,uf,telefone) VALUES(:nome, :endereco, :complemento, :numero, :cep, :uf, :telefone)";
                $stmt = $conn->prepare($sql);
                $stmt->execute(
                    array(
                        ':nome' => $nome,
                        ':endereco' => $endereco,
                        ':complemento' => $complemento,
                        ':numero' => $numero,
                        ':cep' => $cep,
                        ':uf' => $uf,
                        ':telefone' => $telefone
                    )
                );
            } else {
                $sql = "UPDATE contatos SET";
                $sql .= " nome= :nome,";
                $sql .= " endereco= :endereco,";
                $sql .= " complemento= :complemento,";
                $sql .= " numero= :numero,";
                $sql .= " cep= :cep,";
                $sql .= " uf= :uf,";
                $sql .= " telefone= :telefone";
                $sql .= " WHERE id= :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute(
                    array(
                        ':nome' => $nome,
                        ':endereco' => $endereco,
                        ':complemento' => $complemento,
                        ':numero' => $numero,
                        ':cep' => $cep,
                        ':uf' => $uf,
                        ':telefone' => $telefone,
                        ':id' => $codigo
                    )
                );
            }
            $_SESSION["success"] = "Salvo com sucesso.";
            header('Location: ' . $viewsucess);
        }

        ###################################################
        # DELEÇÃO
        ###################################################
        if ($operacao == "E") {
            $sql = "DELETE FROM  contatos WHERE id= :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute(
                array(
                    ':id' => $codigo
                )
            );
            $_SESSION["success"] = "Deletado com sucesso.";
            header('Location: ' . $viewsucess);
        }

      } catch(PDOException $e) {
        $_SESSION["error"] = $e->getMessage();
        header('Location: '.$viewerror);
      }

?>
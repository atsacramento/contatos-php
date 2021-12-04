<?php 
    if (isset($_SESSION["success"])) { 
?>
        <div class="alert alert-success" role="alert">
            <span>
                <strong>MENSAGEM: </strong>
                <?php 
                    $mensagem = $_SESSION["success"];
                    echo $mensagem;
                    unset($_SESSION['success']);
                ?>
            </span>
            <button id="btFechar" type="button" class="close" data-dismiss="alert" aria-label="Close" style="text-align: right">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
<?php
    }
?>
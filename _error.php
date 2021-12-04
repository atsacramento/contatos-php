<?php 
    if (isset($_SESSION["error"])) { 
?>
        <div class="alert alert-danger" role="alert">
            <span>
                <strong>ERROR: </strong>
                <?php 
                    $mensagem = $_SESSION["error"];
                    echo $mensagem;
                    unset($_SESSION['error']);
                ?>
            </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="text-align: right">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
<?php
    }
?>
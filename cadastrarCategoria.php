<?php
    session_start();
    $titulo = "Cadastrar Categoria";
    include './includes/logado.php';
    include("./includes/head.php");
    include("./includes/menu.php");
?>

    <div class="container">
        <form  class="formCategoria" action="cadastrarCategoria.act.php" method="post">
            <p>Nome da Categoria</p>
            <input type="text" name="nome">
            <input type="submit" id="botao" value="Cadastrar">
                <div class="mensagemContainer"><?php
                    if(isset($_SESSION['msg'])){
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);    
                    }
                ?></div>
        </form>
    </div>


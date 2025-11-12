<?php

$titulo = "Cadastrar Perfume";
require('./includes/connect.php');
include './includes/logado.php';
include("./includes/head.php");
include("./includes/menu.php");



$sql_categorias = "
    SELECT nome
    FROM categorias
    ORDER BY nome ASC";
?>
<div class="todo">
    <img src="./imgs/" alt="">
    <form class="formCad"  action="addPerfume.act.php" method="post" enctype="multipart/form-data">
        <p>Marca do Perfume</p>
        <input type="text" name="marcaPerfume">
        <p>Nome do Perfume</p>
        <input type="text" name="nomePerfume" id="">
        <p>Preço do perfume</p>
        <input type="number" name="precoPerfume">
        <p>Descrição do Perfume</p>
        <textarea id="textArea" type="text" rows="5" name="descricaoPerfume"></textarea>
            <p>Imagem Principal</p>
            <input type="file" name="img1" id="">
            <p>2° imagem</p>
            <input type="file" name="img2" id="">
            <p>3° imagem</p>
            <input type="file" name="img3" id="">
            
            <select name="categoria" id="categoria">
                <option value="">Selecione uma categoria</option>
                <?php
                
                    $consulta = mysqli_query($con, "SELECT id, nome FROM categorias ORDER BY nome ASC");

                    if ($consulta && mysqli_num_rows($consulta) > 0) {
                        while ($categoria = mysqli_fetch_assoc($consulta)) {
                            echo '<option value="' . $categoria['id'] . '">' . htmlspecialchars($categoria['nome']) . '</option>';
                        }
                    } else {
                        echo '<option value="">Nenhuma categoria encontrada</option>';
                    }
                ?>
            </select>
        <input id="botao" type="submit" value="Cadastrar" name="enviar">
    </form>

    <div>
        <h1>Cadastrar Perfume</h1>
        <img src="./imgs/PerfumeBoss.png" alt="">
    </div>
    
</div>
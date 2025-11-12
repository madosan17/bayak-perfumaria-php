<?php

@session_start();

if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./imgs/favicon.png" type="image/x-icon">
    <title>BAYAK - Login</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body> 
    <?php include('./includes/menu.php'); 
?>
 <div class="todo">
    <div class="container">
            
            <div class="header">
                <a href="./index.php"><img src="./imgs/imgLogo.png" alt=""></a>
            </div> 

            <?php
            // A mensagem de erro está ótima aqui
            if (isset($_GET['erro']) && $_GET['erro'] == 1) {
                echo '<p class="mensagem erro">Usuário ou senha incorretos.</p>';
            }
            ?>
            
            <form action="valida_login.php" method="POST">
                <div class="form-group">
                    <label for="username">USUARIO</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="senha">SENHA</label>
                    <input type="password" id="senha" name="senha" required>
                </div>

                
                <button type="submit" class="btn-submit">Entrar</button>

                <div class="login-link">
                    Ainda não tem conta? <a href="./cadastro_simple.php">Faça o cadastro</a>
                </div>
                
            </form>
        </div>
    </div>
</body>
</html>
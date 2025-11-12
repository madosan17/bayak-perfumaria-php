<?php
session_start();


if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
 
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
       
        .painel-content {
            background-color: #0d0d0d;
            padding: 50px;
            border-radius: 8px;
            text-align: center;
            border: 1px solid var(--cor-dourado);
        }
        .painel-content h1 {
            color: var(--cor-dourado);
        }
        .painel-content a {
            color: var(--cor-dourado);
            text-decoration: none;
            display: block;
            margin-top: 20px;
        }
        .painel-content a:hover {
            color: #ffaa00;
        }
    </style>
</head>
<body>

    <div class="painel-content">
        <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p>Você acessou a área restrita do sistema BAYAK.</p>
        <a href="logout.php">Sair (Logout)</a>
    </div>

</body>
</html>
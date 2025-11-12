<?php

require_once 'config.php';

session_start(); 



try {
     $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
} catch (PDOException $e) {
    
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $senha_digitada = $_POST['senha'] ?? '';

    
    $stmt = $pdo->prepare("SELECT id, email, senha, tipo, nome FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        
        if (password_verify($senha_digitada, $user['senha'])) {
           
            $_SESSION['logado'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['nome'];
            $_SESSION['tipo'] = $user['tipo'];

            header("Location: index.php"); 
            exit();

        } else {
         
            header("Location: login.php?erro=1");
            exit();
        }
    } else {
        
        header("Location: login.php?erro=1");
        exit();
    }
} else {
    
    header("Location: login.php");
    exit();
}
?>
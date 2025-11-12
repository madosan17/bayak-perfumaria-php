<?php
include("connect.php");

// Apenas rode esse script uma vez e depois delete ou proteja
$nome = 'Administrador';
$email = 'admin@bayak.com';
$senha = password_hash('admin', PASSWORD_DEFAULT);
$tipo = 'admin';

$sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, 'ssss', $nome, $email, $senha, $tipo);
mysqli_stmt_execute($stmt);

echo "Admin criado com sucesso!";
?>
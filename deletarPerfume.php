<?php

require_once "./includes/logado.php";
require_once './includes/connect.php';


if (isset($_GET['id']) && !empty($_GET['id'])) {
    
    $id = $_GET['id'];
    

    $sql = "DELETE FROM Perfumes WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    
    
    mysqli_stmt_bind_param($stmt, "i", $id); 
    
    // Executa
    if (mysqli_stmt_execute($stmt)) {
 
        header("Location: todosPerfumes.php?status=deletado");
        exit;
    } else {
        echo "Erro ao deletar: " . mysqli_error($con);
    }

} else {

    header("Location: todosPerfumes.php");
    exit;
}
?>
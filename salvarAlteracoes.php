<?php
@session_start();

require_once "./includes/logado.php";

if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'admin'){
    die("Acesso negado.");
}

require_once './includes/connect.php'; 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    
    $id_perfume = $_POST['id_perfume']; 
    $nome = $_POST['nome'];
    $marca = $_POST['marca'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $id_categoria = $_POST['id_categoria'];
    

    if (empty($id_perfume) || empty($nome) || empty($marca) || empty($preco) || empty($id_categoria)) {
        die("Erro: Dados incompletos.");
    }


    $sql = "UPDATE Perfumes SET 
                nome = ?,
                marca = ?,
                preco = ?,
                descricao = ?,
                id_categoria = ? 
            WHERE 
                id = ?";
                
    $stmt = mysqli_prepare($con, $sql);

    mysqli_stmt_bind_param($stmt, "ssdsii", 
        $nome, 
        $marca, 
        $preco, 
        $descricao, 
        $id_categoria, 
        $id_perfume
    );
    

    if (mysqli_stmt_execute($stmt)) {
     
        header("Location: todosPerfumes.php?status=alterado");
        exit;
    } else {
        echo "Erro ao salvar as alterações: " . mysqli_error($con);
    }

} else {

    header("Location: todosPerfumes.php");
    exit;
}
?>
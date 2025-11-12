<?php
    require_once './includes/connect.php';
    require_once './includes/logado.php';
    include './includes/logado.php';
    extract($_POST);
    $msg = "";
    session_start();

    $nome = trim($nome);

    if(empty($nome)){
        $_SESSION['msg'] = "<p class=msgErro>O nome da Categoria não pode estar vazio</p>";
        header('location:cadastrarCategoria.php');
        exit();
    }

    $sql = "SELECT id FROM categorias WHERE nome = '$nome'";
    
    $consulta = mysqli_query($con,$sql);

    if($consulta->num_rows > 0){
        $_SESSION['msg']  = "<p class=msgErro>A categoria já existe</p>";
    }

    if($consulta->num_rows==0){
        mysqli_query($con,"INSERT INTO categorias(nome) VALUES ('$nome')");
        $_SESSION['msg']  = "<p class=msgCorreto>Registro Criado com sucesso</p>";
    }

    header('location:cadastrarCategoria.php');
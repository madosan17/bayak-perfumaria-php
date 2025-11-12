<?php
// 1. Configuração e Sessão
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once './includes/connect.php'; 
include './includes/logado.php';

$diretorio_destino = "imgs/perfumes/"; 

// --- Função para Upload de Imagem ---
function fazerUpload($arquivo, $diretorio_destino, $con) {
    if (isset($arquivo) && $arquivo['error'] == 0) {
        $extensao = strtolower(pathinfo(basename($arquivo['name']), PATHINFO_EXTENSION));
        $novo_nome = uniqid() . "." . $extensao;
        $caminho_completo = $diretorio_destino . $novo_nome;

        if (!is_dir($diretorio_destino)) {
            mkdir($diretorio_destino, 0777, true);
        }

        if (move_uploaded_file($arquivo['tmp_name'], $caminho_completo)) {
            return $novo_nome; 
        } else {
            return false;
        }
    }
    return null; 
}
// --- Fim Função ---

// 2. Coleta e Validação dos Dados
$marca = mysqli_real_escape_string($con, $_POST['marcaPerfume']);
$nome = mysqli_real_escape_string($con, $_POST['nomePerfume']);
$preco = mysqli_real_escape_string($con, $_POST['precoPerfume']);
$descricao = mysqli_real_escape_string($con, $_POST['descricaoPerfume']);
$id_categoria = mysqli_real_escape_string($con, $_POST['categoria']);

if (empty($nome) || empty($marca) || empty($preco) || empty($descricao) || empty($id_categoria) || 
    $_FILES['img1']['error'] !== 0) { 

    $_SESSION['msg'] = "<p class='msgErro'>Por favor, preencha todos os campos obrigatórios e envie a Imagem Principal.</p>";
    header("Location: addPerfume.php");
    exit;
}

// 3. Upload e Inserção
$img_frente = fazerUpload($_FILES['img1'], $diretorio_destino, $con);
$img_lado = fazerUpload($_FILES['img2'], $diretorio_destino, $con);
$img_tras = fazerUpload($_FILES['img3'], $diretorio_destino, $con);

if (!$img_frente) {
    $_SESSION['msg'] = "<p class='msgErro'>Erro ao fazer upload da imagem principal. Verifique as permissões.</p>";
    header("Location: addPerfume.php");
    exit;
}

$cadastrar = "INSERT INTO `perfumes` (`marca`, `nome`, `preco`, `descricao`, `img_frente`, `img_lado`, `img_tras`, `id_categoria`)
              VALUES ('$marca', '$nome', '$preco', '$descricao', '$img_frente', '$img_lado', '$img_tras', '$id_categoria')";

if (mysqli_query($con, $cadastrar)) {
    $_SESSION['msg'] = "<p class='msgSucesso'>Perfume **$nome** cadastrado com sucesso!</p>";
} else {
    $_SESSION['msg'] = "<p class='msgErro'>Erro ao cadastrar: " . mysqli_error($con) . "</p>";
}

mysqli_close($con);
header("Location: addPerfume.php"); 
exit; // ESSENCIAL para garantir que o script para aqui e não exibe nada (evita a tela branca)
?>
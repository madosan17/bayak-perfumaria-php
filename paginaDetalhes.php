<?php


@session_start();


require_once './includes/connect.php'; 

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Perfume não especificado."); 
}

$id = $_GET['id'];


$sql = "SELECT 
    Perfumes.*, 
    Categorias.nome AS nome_categoria
FROM 
    Perfumes
JOIN 
    Categorias ON Categorias.id = Perfumes.id_categoria
WHERE 
    Perfumes.id = ?";
$stmt = mysqli_prepare($con, $sql); 
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$perfume = mysqli_fetch_assoc($resultado);


if (!$perfume) {
    die("Perfume não encontrado.");
}
$titulo = $perfume['marca'] . "-" . $perfume['nome'];
include './includes/head.php'; 
include './includes/menu.php';
?>


<div class="detalhe-container">


    <div class="detalhe-coluna-esquerda">
        <div class="slider-css">
            
            <input type="radio" name="slider" id="slide1" checked>
            <input type="radio" name="slider" id="slide2">
            <input type="radio" name="slider" id="slide3">

            <div class="slides">
                <div class="slide">
                    <img src="<?php echo './imgs/perfumes/' . htmlspecialchars($perfume['img_frente']); ?>" alt="Imagem 1 do <?php echo htmlspecialchars($perfume['nome']); ?>">
                </div>
                <div class="slide">
                    <img src="<?php echo './imgs/perfumes/' . htmlspecialchars($perfume['img_lado'] ?? $perfume['img_frente']); ?>" alt="Imagem 2 do <?php echo htmlspecialchars($perfume['nome']); ?>">
                </div>
                <div class="slide">
                    <img src="<?php echo './imgs/perfumes/' . htmlspecialchars($perfume['img_tras'] ?? $perfume['img_frente']); ?>" alt="Imagem 3 do <?php echo htmlspecialchars($perfume['nome']); ?>">
                </div>
            </div>

            <div class="slider-nav">
                <label for="slide1"></label>
                <label for="slide2"></label>
                <label for="slide3"></label>
            </div>
        </div>
    </div>

    <div class="detalhe-coluna-direita">
        
        <h4 class="detalhe-categoria"><?php echo htmlspecialchars($perfume['nome_categoria'] ?? 'Fragrância'); ?></h4>
        
        <h1 class="detalhe-nome-produto"><?php echo htmlspecialchars($perfume['marca'] . ' - ' . $perfume['nome']); ?></h1>
        
        <p class="detalhe-descricao">
            <?php echo nl2br(htmlspecialchars($perfume['descricao'] ?? 'Descrição não disponível.')); ?>
        </p>

        <div class="detalhe-preco-bloco">
            <?php
            $preco = $perfume['preco'];
           
            if (isset($_SESSION['logado']) && $_SESSION['logado'] == true && $_SESSION['tipo'] != 'admin') {
                $preco_desconto = $preco * 0.90;
                
                echo '<span class="preco-antigo">R$ ' . number_format($preco, 2, ',', '.') . '</span>';
                echo '<span class="preco-novo">R$ ' . number_format($preco_desconto, 2, ',', '.') . '</span>';
                echo '<span class="tag-desconto">10% OFF Cliente</span>';

            } else {

                echo '<span class="preco-normal">R$ ' . number_format($preco, 2, ',', '.') . '</span>';
            }
            ?>
        </div>

        <a href="#" class="btn-comprar">Adicionar ao Carrinho</a>
        
    </div>

</div>
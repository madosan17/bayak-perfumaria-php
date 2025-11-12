<?php

require_once './includes/connect.php'; 
@session_start();

$termo_busca = $_POST['busca'] ?? ''; 


$resultado = null;

if (!empty($termo_busca)) {

    $sql = "SELECT p.id, p.marca, p.nome, p.preco, p.img_frente, c.nome AS categoria_nome 
            FROM perfumes p
            JOIN categorias c ON p.id_categoria = c.id
            WHERE p.nome LIKE ?"; 
    
    $stmt = mysqli_prepare($con, $sql);
    $termo_like = "%$termo_busca%";
    mysqli_stmt_bind_param($stmt, "s", $termo_like);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt); 

}
if ($resultado && mysqli_num_rows($resultado) > 0) {
    
  
    while ($perfume = mysqli_fetch_assoc($resultado)) {
        $preco_formatado = number_format($perfume['preco'], 2, ',', '.');
        
    
        echo '<div class="perfume-card">';
        echo '  <img src="./imgs/perfumes/' . htmlspecialchars($perfume['img_frente']) . '" alt="' . htmlspecialchars($perfume['nome']) . '">';
        echo '  <p class="perfume-categoria">' . htmlspecialchars($perfume['categoria_nome']) . '</p>'; 
        echo '  <h3 class="perfume-marca">' . htmlspecialchars($perfume['marca']) . '</h3>';
        echo '  <p class="perfume-nome">' . htmlspecialchars($perfume['nome']) . '</p>';
        echo '  <p class="perfume-preco">R$ ' . $preco_formatado . '</p>';

         if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'admin'){
                    echo '<a href="deletarPerfume.php?id=' . htmlspecialchars($perfume['id']) . '" 
                            class="btn-deletar" 
                            onclick="return confirm(\'Tem certeza que deseja deletar este perfume?\');"
                            style="color: red;">
                                Deletar
                        </a>';
                }
        echo '  <a href="#" class="btn-comprar">Ver Detalhes</a>';
        echo '</div>';
    } 

} else {
  
    if (!empty($termo_busca)) {
        echo "<p style='color: white; text-align: center; width: 100%;'>
                Nenhum perfume encontrado para a busca: '" . htmlspecialchars($termo_busca) . "'
              </p>";
    } else {
      
    }
}

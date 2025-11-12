<?php
require_once './includes/connect.php'; 



$titulo = "Perfumes";
include('./includes/head.php');
include('./includes/menu.php');
?>

<div class="container-pesquisa" style="width: 80%; margin: 40px auto; text-align: center;">
    
    <form id="form-busca" action="todosPerfumes.php" method="GET" style="display: flex; gap: 10px;">
        
        <input type="text" name="busca" id="campo-busca" placeholder="Digite o nome do perfume..." class="pesquisar" 
               value="<?php echo htmlspecialchars($_GET['busca'] ?? ''); ?>">
               
        <button type="submit" class="btn-pesquisar" >
            Pesquisar
        </button>
    </form>

</div>
<div class="fragrancias">
    
    <div class="lista-perfumes" id="lista-perfumes-ajax"> 
    
    <?php
    
    if (empty($_GET['busca'])) {
        
        $sql = "SELECT p.id, p.marca, p.nome, p.preco, p.img_frente, c.nome AS categoria_nome 
                FROM perfumes p
                JOIN categorias c ON p.id_categoria = c.id
                ORDER BY p.id DESC"; 
        $resultado = mysqli_query($con, $sql);
        
        if (mysqli_num_rows($resultado) > 0) {
            
            while ($perfume = mysqli_fetch_assoc($resultado)) {
                $preco_formatado = number_format($perfume['preco'], 2, ',', '.');
                
          
                echo '<div class="perfume-card">';
                echo ' <img src="./imgs/perfumes/' . htmlspecialchars($perfume['img_frente']) . '" alt="' . htmlspecialchars($perfume['nome']) . '">';
                echo ' <p class="perfume-categoria">' . htmlspecialchars($perfume['categoria_nome']) . '</p>'; 
                echo ' <h3 class="perfume-marca">' . htmlspecialchars($perfume['marca']) . '</h3>';
                echo ' <p class="perfume-nome">' . htmlspecialchars($perfume['nome']) . '</p>';
                echo ' <p class="perfume-preco">R$ ' . $preco_formatado . '</p>';

                 if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'admin'){
                    echo '<a href="deletarPerfume.php?id=' . htmlspecialchars($perfume['id']) . '" 
                            class="btn-deletar" 
                            onclick="return confirm(\'Tem certeza que deseja deletar este perfume?\');"
                            style="color: red;">
                                Deletar
                        </a>';
                    echo '<a href="editarPerfume.php?id=' . htmlspecialchars($perfume['id']) . '" 
                        class="btn-alterar"    
                        style="color: #e0c490; text-decoration: none;">
                                Alterar
                            </a>';
                    }

                    echo ' <a href="paginaDetalhes.php?id=' . htmlspecialchars($perfume['id']) . '" class="btn-comprar" style="width: 100%;">Ver Detalhes</a>';
                echo '</div>';
            } 
            
        } else {
         
            echo "<p style='color: white; text-align: center; width: 100%;'>
                  Nenhum perfume cadastrado no momento.
                  </p>";
        }
    }
   
    ?>
    </div> 
</div>

<script src="./libs/jquery-3.7.1.min.js"></script>
<script src="./includes/app.js"></script>
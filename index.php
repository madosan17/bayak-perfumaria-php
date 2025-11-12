
<?php

@session_start(); 
?>
<?php
$titulo = "Bayak Perfums"; 

require_once('./includes/connect.php'); 
include("./includes/head.php");
include("./includes/menu.php"); 
?> 


<div class="banner">
  <video class="video-background" autoplay loop muted playsinline>
          <source src="./imgs/vidLogin2.mp4" type="video/mp4">
          Seu navegador não suporta vídeos.
 </video>
 <?php

     if (isset($_SESSION['username']) && !empty($_SESSION['username'])) :

                $nomeCompleto = $_SESSION['username'];
         $partesNome = explode(' ', $nomeCompleto); 
         $primeiroNome = htmlspecialchars($partesNome[0]); 
         ?>

            <a href="#frag" class="btnBanner" style=" left: 600px;">
                Bem vindo(a) <?php echo $primeiroNome; ?> ! <br>Temos ofertas especiais e cheiros únicos pra você!
           </a>

        <?php else: ?>

        <a href="#frag" class="btnBanner">DESCUBRA AS FRAGRÂNCIAS</a>

        <?php endif; ?>
  </div>
  
<div class="fragrancias">
     <h1 id="frag">Fragrâncias</h1>
      
    <div class="filtro-categoria">
        <?php
        
        $categoria_selecionada = isset($_GET['filtro_categoria']) ? $_GET['filtro_categoria'] : '';
        ?>
        <form method="get" action="index.php" class="form-filtro">
            <select name="filtro_categoria" id="filtro_categoria" onchange="this.form.submit()">
                <option value="">Todas as Categorias</option>
                <?php
                
                $sql_categorias = "SELECT id, nome FROM categorias ORDER BY nome ASC";
                $resultado_categorias = mysqli_query($con, $sql_categorias);

                if ($resultado_categorias && mysqli_num_rows($resultado_categorias) > 0) {
                    while ($categoria = mysqli_fetch_assoc($resultado_categorias)) {
                        $selected = ($categoria['id'] == $categoria_selecionada) ? 'selected' : '';
                        echo '<option  value="' . $categoria['id'] . '" ' . $selected . '>' . htmlspecialchars($categoria['nome']) . '</option>';
                    }
                }
                ?>
            </select>
        </form>
    </div>
          <div class="lista-perfumes">

             <?php
             
            $where_clause = "";
            if (!empty($categoria_selecionada)) {
                $categoria_id = mysqli_real_escape_string($con, $categoria_selecionada);
                
                $where_clause = " WHERE p.id_categoria = '$categoria_id'";
            }
 
            
               $sql_perfumes = "SELECT 
                            p.id, 
                            p.marca, 
                            p.nome, 
                            p.preco, 
                           (p.preco * 0.90) AS preco_promocional, 
                            p.img_frente,
                            c.nome AS categoria_nome 
                         FROM perfumes p
                         JOIN categorias c ON p.id_categoria = c.id"
                             . $where_clause . 
                           " ORDER BY p.id DESC";

        $resultado_perfumes = mysqli_query($con, $sql_perfumes);

         if ($resultado_perfumes && mysqli_num_rows($resultado_perfumes) > 0) {
         while ($perfume = mysqli_fetch_assoc($resultado_perfumes)) {
 

                $preco_promocional_formatado = number_format($perfume['preco_promocional'], 2, ',', '.');
                $preco_formatado = number_format($perfume['preco'], 2, ',', '.');

                echo '<div class="perfume-card">';
                echo ' <img src="./imgs/perfumes/' . htmlspecialchars($perfume['img_frente']) . '" alt="' . htmlspecialchars($perfume['nome']) . '">';
                echo ' <p class="perfume-categoria">' . htmlspecialchars($perfume['categoria_nome']) . '</p>'; 
                echo ' <h3 class="perfume-marca">' . htmlspecialchars($perfume['marca']) . '</h3>';
                echo ' <p class="perfume-nome">' . htmlspecialchars($perfume['nome']) . '</p>';


                   if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'cliente') {
                      echo ' <p class="perfume-preco" style="line-height: 1.2;">
                     <span style="text-decoration: line-through; color: #888; font-size: 0.8em;">De: R$ ' . $preco_formatado . '</span>
                     <br>10% de desconto! Por: R$ ' . $preco_promocional_formatado . 
                      '</p>';
                 } else {

               echo ' <p class="perfume-preco">R$ ' . $preco_formatado . '</p>';
                  }


echo '<div class="card-botoes">';
                
                
                      if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'admin'){
                    echo '<a href="deletarPerfume.php?id=' . htmlspecialchars($perfume['id']) . '" 
                            class="btn-apagar" 
                               onclick="return confirm(\'Tem certeza que deseja deletar este perfume?\');">
                               Deletar
                              </a>';
                     echo '<a href="editarPerfume.php?id=' . htmlspecialchars($perfume['id']) . '" 
                         class="btn-alterar" 
                          style="color: #e0c490; text-decoration: none; padding: 8px 10px;">
                           Alterar
                           </a>';
                      echo '<a href="paginaDetalhes.php?id=' . htmlspecialchars($perfume['id']) . '" class="btn-comprar">Ver Detalhes</a>';

                     } else { 
                        echo ' <a href="paginaDetalhes.php?id=' . htmlspecialchars($perfume['id']) . '" class="btn-comprar" style="width: 100%;">Ver Detalhes</a>';
                    }
                echo '</div>';
 
             echo '</div>'; 
            }
          } else {
              echo '<p class="aviso-vazio">Nenhum perfume cadastrado ainda ou encontrado nesta categoria.</p>';
        }

         @mysqli_close($con); 
          ?>
  </div> 
     </div>
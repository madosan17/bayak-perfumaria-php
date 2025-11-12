    <div class="menu">
        <a href="./index.php"><img id="iconLogo" src="./imgs/imgLogo.png" alt=""></a>

        <ul>
            <li><a href="./todosPerfumes.php">Perfumes</a></li>
            
            <?php 
            @session_start();
            if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'admin'){
                // CORRIGIDO:
                echo '<li><a href="./addPerfume.php">Cadastrar Perfumes</a></li>';
                
                // CORRIGIDO:
                echo '<li><a href="./cadastrarCategoria.php">Cadastrar Categoria</a></li>';
            }
            ?>
        </ul>

        
        
        

            <?php        
            if(isset($_SESSION['logado']) && $_SESSION['logado']== true){
                echo '<a href=./logout.php class=sair>sair</a>';
            }else{
                echo '<a href="./login.php"><img id="iconLogin" src="./imgs/iconLogin.png" alt=""></a>';
            }
            ?>
    </div>
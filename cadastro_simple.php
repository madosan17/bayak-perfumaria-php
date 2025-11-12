<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'bd_bayak'); 
define('DB_USER', 'root');
define('DB_PASS', '');

$mensagem = '';
$tipo_mensagem = '';
$dados_form = []; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 
    $nome  = trim($_POST['nome'] ?? '');
    $email = trim(strtolower($_POST['email'] ?? ''));
    $senha = $_POST['senha'] ?? '';
    $confirma_senha = $_POST['confirma_senha'] ?? '';

    $dados_form = ['nome' => $nome, 'email' => $email];

    try {
        
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", 
            DB_USER, 
            DB_PASS
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (empty($nome) || empty($email) || empty($senha)) {
            throw new Exception('Preencha todos os campos!');
        }
        if ($senha !== $confirma_senha) {
            throw new Exception('As senhas não coincidem!');
        }

        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            throw new Exception('Este e-mail já está cadastrado.');
        }

    
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $email, $senha_hash]);
        
      
        $mensagem = 'Cadastro realizado com sucesso!';
        $tipo_mensagem = 'sucesso';
        $dados_form = []; 

    } catch (PDOException $e) {
        $mensagem = 'Erro no banco: Não foi possível cadastrar.';
        $tipo_mensagem = 'erro';
    } catch (Exception $e) {
       
        $mensagem = $e->getMessage();
        $tipo_mensagem = 'erro';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./imgs/favicon.png" type="image/x-icon">
    <title>BAYAK - Cadastro Simples</title>
    <style>
       @font-face {
        font-family: playfair;
        src: url(./fonts/Playfair_Display/PlayfairDisplay-Italic-VariableFont_wght.ttf);
       }
       

        :root {
            --cor-fundo-principal: #0a0a0a;
            --cor-container: #141414;
            --cor-dourado: #d4af37;
             --corTexto:white;
            --cor-dourado-claro: #f4e5b1;
            --cor-input-bg: rgba(30, 30, 30, 0.8);
            --cor-input-border: rgba(60, 60, 60, 0.6);
            --cor-sombra-dourada: rgba(212, 175, 55, 0.3);
        }

        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            text-decoration: none;
            list-style: none;
        }


            
        body{
            background: var(--cor-fundo-principal);
        }

        .todo {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: var(--cor-fundo-principal);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        html, body {
            margin: 0;
            padding: 0;
            height: auto;  
            overflow-x: hidden;
            overflow-y: auto;   
        }


        ::-webkit-scrollbar {
        width: 12px;
        }


        ::-webkit-scrollbar-track {
        background: #1a1a1a;
        border: none;     
        }


        ::-webkit-scrollbar-thumb {
        background: #c0a16b; 
        border-radius: 10px; 
        border: 2px solid #1a1a1a;
        }


        ::-webkit-scrollbar-thumb:hover {
        background: #e0c490;
        }

        .menu{
            background-color: var(--corFundo);
            display: flex;
            align-items: center;
            height: 80px;
            text-align: center;
            justify-content: center;
        }
        .menu>a>img{
            height: 100px;
            position: absolute;
            top: 0;
            cursor: pointer;
            transition: 1.0s;
        }
        .menu>a>img:hover{
            scale:105%;
        }
        .menu ul{
            display: flex;
            font-family: playfair;
        }
        .menu ul li a {
            position: relative; /* Define o contexto para o pseudo-elemento ::after */
            color: var(--corTexto);
            padding: 5px; /* Adiciona um respiro para o sublinhado não ficar colado */
            transition: color 0.3s ease;
        }
        .sair{
            position: absolute;
            right: 0;
            margin-right: 20px;
            color: var(--corDourado);
            font-size: 20px;
        }

        /* Pseudo-elemento para criar o sublinhado animado */
        .menu ul li ::after {
            content: "";
            position: absolute;
            bottom: 0; /* Posição do sublinhado */
            left: 0;
            width: 0%; /* Começa com largura zero */
            height: 2px; /* Espessura do sublinhado */
            background-color: #C0A062;
            transition: width 0.3s ease-in-out; /* Animação da largura */
        }

        /* Ativa a animação quando o mouse está sobre o link */
        .menu ul li :hover::after {
            width: 100%; /* Aumenta a largura para 100% no hover */
        }

        /* Opcional: Mudar a cor do texto no hover */
        .menu ul li  :hover {
            color: #C0A062;
        }

        #iconLogin{
            right: 0;
            top: 20px;
            height: 50px;
        }
        #iconLogo{
            left: 0;
        }

        .container {
            background: var(--cor-container);
            padding: 40px;
            border-radius: 12px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(212, 175, 55, 0.1);
        }

        .header h2 {
            color: var(--cor-dourado);
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
            letter-spacing: 2px;
        }
        .header{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .header p {
            color: #777;
            text-align: center;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .header>a>img{
            height: 200px;
            width: 200px;
            cursor: pointer;
            transition: 1.0s;
        }
        .header>a>img:hover{
            scale: 105%;
        }

        .mensagem {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
        }

        .mensagem.sucesso {
            background: rgba(76, 175, 80, 0.15);
            border: 1px solid rgba(76, 175, 80, 0.4);
            color: #66bb6a;
        }

        .mensagem.erro {
            background: rgba(244, 67, 54, 0.15);
            border: 1px solid rgba(244, 67, 54, 0.4);
            color: #ef5350;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: var(--cor-dourado);
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        input {
            width: 100%;
            padding: 12px 15px;
            background: var(--cor-input-bg);
            border: 2px solid var(--cor-input-border);
            border-radius: 8px;
            color: #fff;
            font-size: 15px;
            transition: all 0.3s ease;
            outline: none;
        }

        input:focus {
            border-color: var(--cor-dourado);
            background: #1e1e1e;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.15);
        }

    
        .btn-submit {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, var(--cor-dourado) 0%, var(--cor-dourado-claro) 50%, var(--cor-dourado) 100%);
            border: none;
            border-radius: 8px;
            color: #000;
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            box-shadow: 0 4px 15px var(--cor-sombra-dourada);
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px var(--cor-sombra-dourada);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #777;
            font-size: 14px;
        }

        .login-link a {
            color: var(--cor-dourado);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .login-link a:hover {
            color: var(--cor-dourado-claro);
            text-decoration: underline;
        }

    
        .password-toggle { display: none; }
    </style>
</head>


<body>

    <?php
        include('./includes/menu.php');
    ?>
    <div class="todo">
            <div class="container">
                <div class="header">
                    <a href="./index.php"><img src="./imgs/imgLogo.png" alt=""></a>
                </div>

                <?php if ($mensagem): ?>
                    <div class="mensagem <?php echo $tipo_mensagem; ?>">
                        <?php echo htmlspecialchars($mensagem); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">

                    <div class="form-group">
                        <label for="nome">Nome Completo</label>
                        <input type="text" id="nome" name="nome" placeholder="Seu nome" 
                            value="<?php echo htmlspecialchars($dados_form['nome'] ?? ''); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" placeholder="seu@email.com" 
                            value="<?php echo htmlspecialchars($dados_form['email'] ?? ''); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" id="senha" name="senha" placeholder="Sua senha" required>
                    </div>

                    <div class="form-group">
                        <label for="confirma_senha">Confirmar Senha</label>
                        <input type="password" id="confirma_senha" name="confirma_senha" placeholder="Digite a senha novamente" required>
                    </div>

                    <button type="submit" class="btn-submit">Cadastrar</button>
                </form>

                <div class="login-link">
                    Já tem conta? <a href="./login.php">Faça Login</a>
                </div>

            </div>

    </div>
</body>
</html>
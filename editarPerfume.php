<?php
@session_start();

require_once "./includes/logado.php";

if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'admin'){
    die("Acesso negado.");
}

require_once './includes/connect.php'; 

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID não fornecido.");
}
$id_perfume = $_GET['id'];


$sql_perfume = "SELECT * FROM Perfumes WHERE id = ?";
$stmt_perfume = mysqli_prepare($con, $sql_perfume);
mysqli_stmt_bind_param($stmt_perfume, "i", $id_perfume);
mysqli_stmt_execute($stmt_perfume);
$resultado_perfume = mysqli_stmt_get_result($stmt_perfume);
$perfume = mysqli_fetch_assoc($resultado_perfume);

if (!$perfume) {
    die("Perfume não encontrado.");
}


$sql_categorias = "SELECT * FROM Categorias ORDER BY nome";
$resultado_categorias = mysqli_query($con, $sql_categorias);

$titulo = "Alterar - " . $perfume['nome'];
include './includes/head.php';
include './includes/menu.php'; 
?>

<div style="margin: 40px auto; max-width: 800px; height: auto;">
    
    <form class="formCategoria" style="margin: 40px auto; max-width: 800px; height: auto;" action="salvarAlteracoes.php" method="POST">

        <h1>Alterar Perfume</h1>

        <input type="hidden" name="id_perfume" value="<?php echo htmlspecialchars($perfume['id']); ?>">

        <p>Nome do Perfume:</p>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($perfume['nome']); ?>" required>

        <p>Marca:</p>
        <input type="text" name="marca" value="<?php echo htmlspecialchars($perfume['marca']); ?>" required>

        <p>Preço (ex: 320.00):</p>
        <input type="text" name="preco" value="<?php echo htmlspecialchars($perfume['preco']); ?>" required>

        <p>Descrição:</p>
        <textarea id="textArea" name="descricao" rows="5"><?php echo htmlspecialchars($perfume['descricao']); ?></textarea>

        <p>Categoria:</p>
        <select id="categoria" name="id_categoria" required>
            <option value="">Selecione uma categoria</option>
            <?php
          
            while ($categoria = mysqli_fetch_assoc($resultado_categorias)) {
         
                $selected = ($categoria['id'] == $perfume['id_categoria']) ? 'selected' : '';
                
                echo '<option value="' . htmlspecialchars($categoria['id']) . '" ' . $selected . '>' 
                   . htmlspecialchars($categoria['nome']) 
                   . '</option>';
            }
            ?>
        </select>
        
        <input type="submit" id="botao" value="Salvar Alterações">
    </form>
</div>
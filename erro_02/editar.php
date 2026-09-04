<?php
require_once 'config/conexao.php';

if (isset($_POST['atualizar'])) {

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];

    $sql = "UPDATE produtos
            SET nome = ?, categoria = ?, preco = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssdii",
        $nome,
        $categoria,
        $preco,
        $estoque,
        $id
    );

    $stmt->execute();

    header("Location: index.php");
    exit;
}

$id = $_GET['id'] ?? null;
$produto = null;

if ($id) {
    $sql = "SELECT * FROM produtos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $produto = $resultado->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
</head>
<body>

    <h1>Editar Produto</h1>

    <?php if ($produto) { ?>
        <form action="editar.php" method="POST">

            <input type="hidden" name="id" value="<?= $produto['id'] ?>">

            <label>Nome:</label>
            <input type="text" name="nome" value="<?= $produto['nome'] ?>" required>
            <br><br>

            <label>Categoria:</label>
            <input type="text" name="categoria" value="<?= $produto['categoria'] ?>" required>
            <br><br>

            <label>Preço:</label>
            <input type="number" step="0.01" name="preco" value="<?= $produto['preco'] ?>" required>
            <br><br>

            <label>Estoque:</label>
            <input type="number" name="estoque" value="<?= $produto['estoque'] ?>" required>
            <br><br>

            <button type="submit" name="atualizar">
                Atualizar Produto
            </button>

        </form>
    <?php } else { ?>
        <p>Produto não encontrado.</p>
    <?php } ?>

    <br>
    <a href="index.php">Voltar para a listagem</a>

</body>
</html>
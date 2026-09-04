<?php
require_once 'config/conexao.php';

if (isset($_POST['cadastrar'])) {

    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];

    $sql = "INSERT INTO produtos
            (nome, categoria, preco, estoque)
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssdi", $nome, $categoria, $preco, $estoque);

    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
</head>
<body>

    <h1>Cadastro de Produtos</h1>

    <form action="cadastrar.php" method="POST">

        <label>Nome:</label>
        <input type="text" name="nome" required>
        <br><br>

        <label>Categoria:</label>
        <input type="text" name="categoria" required>
        <br><br>

        <label>Preço:</label>
        <input type="number" step="0.01" name="preco" required>
        <br><br>

        <label>Estoque:</label>
        <input type="number" name="estoque" required>
        <br><br>

        <button type="submit" name="cadastrar">
            Cadastrar Produto
        </button>

    </form>

    <br>
    <a href="index.php">Voltar para a listagem</a>

</body>
</html>
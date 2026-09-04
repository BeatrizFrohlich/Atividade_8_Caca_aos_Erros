<?php
require_once 'config/conexao.php';

if (isset($_GET['excluir'])) {

    $id = $_GET['excluir'];

    $sql = "DELETE FROM produtos WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $id);

    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Produto</title>
</head>
<body>

    <h1>Confirmar Exclusão</h1>

    <p>Deseja realmente excluir o produto ID <?= $_GET['excluir'] ?? '' ?>?</p>

    <a href="excluir.php?excluir=<?= $_GET['excluir'] ?? '' ?>">Sim, excluir</a> |
    <a href="index.php">Cancelar</a>

</body>
</html>
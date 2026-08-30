<?php
require_once 'config/conexao.php';

if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];

    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header('Location: index.php?msg=sucesso');
        exit;
    } else {
        $erro = "Erro ao excluir o registro.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Usuário</title>
</head>
<body>
    <h1>Excluir Usuário</h1>
    
    <?php if (isset($erro)): ?>
        <p style="color: red;"><?= $erro ?></p>
        <a href="index.php">Voltar para a lista</a>
    <?php else: ?>
        <p>Nenhum usuário foi selecionado para exclusão.</p>
        <a href="index.php">Voltar para a página principal</a>
    <?php endif; ?>
</body>
</html>
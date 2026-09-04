<?php
require_once 'config/conexao.php';

$sql = "SELECT id, nome, categoria, preco, estoque
        FROM produtos
        ORDER BY id DESC";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Buscar / Listar Produtos</title>
</head>

<body>

    <h2>Produtos cadastrados</h2>

    <table border="1" cellpadding="8">

        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th>Ações</th>
        </tr>

        <?php while ($produto = $resultado->fetch_assoc()) { ?>

            <tr>
                <td><?= $produto['id'] ?></td>
                <td><?= $produto['nome'] ?></td>
                <td><?= $produto['categoria'] ?></td>
                <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                <td><?= $produto['estoque'] ?></td>
                <td>
                    <a href="editar.php?id=<?= $produto['id'] ?>">
                        Editar
                    </a>
                    |
                    <a href="excluir.php?excluir=<?= $produto['id'] ?>">
                        Excluir
                    </a>
                </td>
            </tr>

        <?php } ?>

    </table>

    <br>
    <a href="index.php">Voltar ao Menu Principal</a>

</body>

</html>
<?php

require_once "config/conexao.php";

// Captura o termo digitado na busca (se houver)
$busca = isset($_GET['busca']) ? $_GET['busca'] : '';

if (!empty($busca)) {
    // Busca por nome ou e-mail correspondente ao termo digitado
    $sql = "SELECT id, nome, email FROM usuarios WHERE nome LIKE ? OR email LIKE ? ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $param_busca = "%" . $busca . "%";
    $stmt->bind_param("ss", $param_busca, $param_busca);
    $stmt->execute();
    $resultado = $stmt->get_result();
} else {
    // Se não houver busca, traz todos os usuários registrados
    $sql = "SELECT id, nome, email FROM usuarios ORDER BY id DESC";
    $resultado = $conn->query($sql);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Buscar Usuários</title>
</head>

<body>

    <h1>Buscar Usuários</h1>

    <!-- Formulário de Pesquisa -->
    <form method="GET" action="buscar_usuario.php">
        <label for="busca">Pesquisar:</label>
        <input type="text" id="busca" name="busca" 
               placeholder="Digite o nome ou e-mail" 
               value="<?= htmlspecialchars($busca) ?>">
        <button type="submit">Buscar</button>
        
        <?php if (!empty($busca)): ?>
            <a href="buscar_usuario.php"><button type="button">Limpar Busca</button></a>
        <?php endif; ?>
    </form>

    <br><br>

    <!-- Tabela de Exibição dos Resultados -->
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Ações</th>
        </tr>

        <?php if ($resultado->num_rows > 0): ?>
            <?php while ($usuario = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= $usuario['id'] ?></td>
                    <td><?= htmlspecialchars($usuario['nome']) ?></td>
                    <td><?= htmlspecialchars($usuario['email']) ?></td>
                    <td>
                        <a href="editar.php?id=<?= $usuario['id'] ?>">Editar</a> | 
                        <a href="index.php?excluir=<?= $usuario['id'] ?>" onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Nenhum usuário encontrado.</td>
            </tr>
        <?php endif; ?>
    </table>

    <br>
    <a href="index.php">Voltar para o Início</a>

</body>

</html>
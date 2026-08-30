<?php

require_once __DIR__ . "/config/conexao.php";

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    die("ID do usuário inválido.");

}

$id = (int) $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);

    if (empty($nome) || empty($email)) {

        die("Erro: preencha todos os campos obrigatórios.");

    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        die("Erro: informe um e-mail válido.");

    }

    $sql = "UPDATE usuarios SET nome = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {

        die("Erro ao preparar a consulta: " . $conn->error);

    }

    $stmt->bind_param( "ssi", $nome, $email, $id);

    if ($stmt->execute()) {

        header("Location: index.php");
        exit;

    } else {

        echo "Erro ao atualizar o usuário: ". htmlspecialchars($stmt->error);

    }

    $stmt->close();

}

$sql = "SELECT id, nome, email FROM usuarios WHERE id = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {

    die("Erro ao preparar a consulta: " . $conn->error);

}

$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {

    die("Usuário não encontrado.");

}

$usuario = $resultado->fetch_assoc();

$stmt->close();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Usuário</title>

</head>

<body>

    <h1>Editar Usuário</h1>

    <form action="editar.php?id=<?= $usuario["id"] ?>" method="POST">

        <label for="nome"> Nome:</label>

        <br>

        <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($usuario["nome"]) ?>"required>

        <br><br>

        <label for="email"> E-mail:</label>

        <br>

        <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario["email"]) ?>" required>

        <br><br>

        <button type="submit"> Salvar alterações </button>

    </form>

    <br>

    <a href="buscar_usuario.php"> Voltar para os usuários</a>
    <a href="index.php">Voltar para a página principal</a>
</body>
</html>

<?php

$conn->close();

?>
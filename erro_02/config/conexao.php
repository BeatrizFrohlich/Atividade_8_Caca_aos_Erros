<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "erro_02";
$porta    = 6608; 

$conn = new mysqli($servidor, $usuario, $senha, $banco, $porta);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>
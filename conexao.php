<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "bd_biblioteca";

$conexao = new mysqli($servidor, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
} else {
    echo "Conexão sucedida!<br>";
}

$nome = "João";
$email = "joao@example.com";

// Usando prepared statement para segurança
$stmt = $conexao->prepare("INSERT INTO clientes (nome, email) VALUES (?, ?)");
$stmt->bind_param("ss", $nome, $email);

if ($stmt->execute()) {
    echo "Registro inserido com sucesso!";
} else {
    echo "Erro ao inserir registro: " . $stmt->error;
}

$stmt->close();
$conexao->close();
?>

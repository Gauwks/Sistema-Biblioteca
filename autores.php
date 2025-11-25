<?php
include_once("conexao.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = $_POST['nome'] ?? '';
    $nacionalidade = $_POST['nacionalidade'] ?? '';
    $dtNascimento = $_POST['dtNascimento'] ?? '';
    $biografia = $_POST['biografia'] ?? '';

    $sql = "INSERT INTO autor (nome, nacionalidade, data_nascimento, biografia)
            VALUES ('$nome', '$nacionalidade', '$dtNascimento', '$biografia')";

    if ($conn->query($sql)) {
        echo "<p style='color: green;'>Autor cadastrado com sucesso!</p>";
    } else {
        echo "<p style='color: red;'>Erro ao cadastrar: " . $conn->error . "</p>";
    }
}

$sqlAutores = "SELECT * FROM autor ORDER BY id_autor DESC LIMIT 5";
$resultAutores = $conn->query($sqlAutores);

if (!$resultAutores) {
    die("Erro na consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Autores</title>
</head>
<body>

<header>
    <h1>Autores</h1>
    <nav>
        <a href="autores.php">Autores</a>
        <a href="livros.php">Livros</a>
        <a href="clientes.php">Clientes</a>
        <a href="emprestimos.php">Empréstimos</a>
    </nav>
</header>

<main>
<section class="AddRecente">
    <h1>Últimos autores cadastrados:</h1>

    <?php if ($resultAutores->num_rows > 0): ?>
        <ul>
            <?php while ($a = $resultAutores->fetch_assoc()): ?>
                <li>
                    <strong><?= $a['nome'] ?></strong> —
                    <?= $a['nacionalidade'] ?> —
                    Nasc.: <?= $a['data_nascimento'] ?>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>Nenhum autor cadastrado ainda.</p>
    <?php endif; ?>

</section>

<section class="cadastrarAutor">
    <h1>Cadastrar autor:</h1>

    <form action="autores.php" method="POST">
        <label>Nome</label>
        <input type="text" name="nome" required>

        <label>Nacionalidade</label>
        <input type="text" name="nacionalidade" required>

        <label>Data de Nascimento</label>
        <input type="date" name="dtNascimento" required>

        <label>Biografia</label>
        <textarea name="biografia" rows="5" required></textarea>

        <button type="submit">Cadastrar</button>
    </form>
</section>
</main>

</body>
</html>

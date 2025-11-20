<?php  
include_once("conexao.php");

// Se o formulário for enviado:
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $titulo        = $_POST['titulo'];
    $categoria     = $_POST['categoria'];
    $dtLancamento  = $_POST['dtLancamento'];
    $qtdPaginas    = $_POST['qtdPaginas'];
    $editora       = $_POST['editora'];
    $autor         = $_POST['autor'];

    // Inserindo no banco
    $sql = "INSERT INTO livros (titulo, categoria, data_lancamento, qtd_pagina, editora, fk_autor)
            VALUES ('$titulo', '$categoria', '$dtLancamento', '$qtdPaginas', '$editora', '$autor')";

    if ($conn->query($sql)) {
        echo "<p style='color: green;'>Livro cadastrado com sucesso!</p>";
    } else {
        echo "<p style='color: red;'>Erro ao cadastrar: " . $conn->error . "</p>";
    }
}

// Buscar os livros já cadastrados
$lista = $conn->query("SELECT l.titulo, l.categoria, l.data_lancamento, a.nome AS autor
                       FROM livros l
                       LEFT JOIN autor a ON l.fk_autor = a.id_autor
                       ORDER BY l.id_livro DESC
                       LIMIT 5");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="Maria Clara da Silva Jacinto, Elizabete Silva Oliveira e Rafael D'Angelo">
    <link rel="stylesheet" href="style.css">
    <title>Livros</title>
</head>
<body>

<header>
    <h1>Livros</h1>
    <nav>
        <a href="autores.php">Autores</a>
        <a href="livros.php">Livros</a>
        <a href="clientes.php">Clientes</a>
        <a href="emprestimos.php">Empréstimos</a>
    </nav>
</header>

<main>

<section class="AddRecente">
    <h1>Últimos livros cadastrados:</h1>

    <?php if ($lista->num_rows > 0): ?>
        <ul>
            <?php while($l = $lista->fetch_assoc()): ?>
                <li>
                    <strong><?= $l['titulo'] ?></strong> – 
                    <?= $l['categoria'] ?> (<?= $l['data_lancamento'] ?>)  
                    — Autor: <?= $l['autor'] ?>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>Nenhum livro cadastrado ainda.</p>
    <?php endif; ?>

</section>

<section class="cadastrarLivro">
    <h1>Cadastrar livro:</h1>

    <form action="livros.php" method="POST">
        <label for="titulo">Título</label>
        <input type="text" name="titulo" id="titulo" maxlength="100" required>

        <label for="categoria">Categoria</label>
        <input type="text" name="categoria" id="categoria" maxlength="50" required>

        <label for="dtLancamento">Data de Lançamento</label>
        <input type="date" name="dtLancamento" id="dtLancamento" required>

        <label for="qtdPaginas">Quantidade de Páginas</label>
        <input type="number" name="qtdPaginas" id="qtdPaginas" min="1" max="5000" required>

        <label for="editora">Editora</label>
        <input type="text" name="editora" id="editora" maxlength="80" required>

        <label for="autor">ID do Autor</label>
        <input type="number" name="autor" id="autor" min="1" required>

        <button type="submit">Cadastrar</button>
    </form>
</section>

</main>
</body>
</html>

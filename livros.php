<?php  
include_once("conexao.php");

$autores = $conn->query("SELECT id_autor, nome FROM autor ORDER BY nome ASC");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $titulo        = $_POST['titulo'];
    $categoria     = $_POST['categoria'];
    $dtLancamento  = $_POST['dtLancamento'];
    $qtdPaginas    = $_POST['qtdPaginas'];
    $editora       = $_POST['editora'];
    $autorID       = $_POST['autor'] === "" ? "NULL" : $_POST['autor'];

    $sql = "INSERT INTO livros (titulo, categoria, data_lancamento, qtd_pagina, editora, fk_autor)
            VALUES ('$titulo', '$categoria', '$dtLancamento', '$qtdPaginas', '$editora', $autorID)";

    if ($conn->query($sql)) {
        echo "<script>alert('Livro cadastrado com sucesso!'); window.location='livros.php';</script>";
        exit;
    } else {
        echo "<script>alert('Erro ao cadastrar: ".$conn->error."');</script>";
    }
}

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
                    — Autor: <?= $l['autor'] ?? "Desconhecido" ?>
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
        <label>Título</label>
        <input type="text" name="titulo" required>

        <label>Categoria</label>
        <input type="text" name="categoria" required>

        <label>Data de Lançamento</label>
        <input type="date" name="dtLancamento" required>

        <label>Quantidade de Páginas</label>
        <input type="number" name="qtdPaginas" required>

        <label>Editora</label>
        <input type="text" name="editora" required>

        <label>Autor</label>
        <select name="autor">
            <option value="">Autor Desconhecido</option>
            <?php while($a = $autores->fetch_assoc()): ?>
                <option value="<?= $a['id_autor'] ?>">
                    <?= $a['nome'] ?>
                </option>
            <?php endwhile; ?>
        </select>

        <button type="submit">Cadastrar</button>
    </form>
</section>

</main>
</body>
</html>

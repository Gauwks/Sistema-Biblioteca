
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

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name= "author" content="Maria Clara da Silva Jacinto, Elizabete Silva Oliveira e Rafael D'Angelo">
    <link rel="stylesheet" href="style.css">
    <title>Empréstimos</title>
</head>
<body>
      
    <header>
   <h1>Empréstimos</h1>
        <nav>
        <a href="autores.php">Autores</a>
        <a href="livros.php">Livros</a>
        <a href="clientes.php">Clientes</a>
        <a href="emprestimos.php">Empréstimos</a>
        </nav>
    </header>

    <main>
        <section class="AddRecente">
            <h1>Últimos empréstimos registrados:</h1>

        </section>

        <section class="cadastrarEmprestimo">
            <h1>Registrar empréstimo:</h1>

            <form action="emprestimos.php" method="POST">

                <label for="fk_cliente">Cliente</label>
                <input type="number" name="fk_cliente" id="fk_cliente" min="1" required>

                <label for="fk_livro">Livro</label>
                <input type="number" name="fk_livro" id="fk_livro" min="1" required>

                <label for="dtEmprestimo">Data do Empréstimo</label>
                <input type="datetime-local" name="dtEmprestimo" id="dtEmprestimo" required>

                <label for="dtDevolucao">Data de Devolução</label>
                <input type="datetime-local" name="dtDevolucao" id="dtDevolucao" required>

                <button type="submit">Registrar</button>
            </form>
        </section>
    </main>
</body>
</html>

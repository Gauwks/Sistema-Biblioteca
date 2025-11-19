<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="Maria Clara da Silva Jacinto, Elizabete Silva Oliveira e Rafael D'Angelo">
    <title>Livros</title>
    <link rel="stylesheet" href="style.css">
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
          <input type="number" name="qtdPaginas" id="qtdPaginas" min="1" max="5000"  required>

          <label for="editora">Editora</label>
          <input type="text" name="editora" id="editora" maxlength="80" required>

          
          <label for="autor">Autor</label>
          <input type="text" name="autor" id="editora" maxlength="80" required>

          <button type="submit">Cadastrar</button>
        </form>
      </section>
    </main>
</body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="Maria Clara da Silva Jacinto, Elizabete Silva Oliveira e Rafael D'Angelo">
    <link rel="stylesheet" href="style.css">
    <title>Clientes</title>
</head>
<body>
 
      
   <header>
   <h1>Clientes</h1>
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
        <h1> Cadastrar autor:</h1>
        <form action="clientes.php" method="POST">
            <label>Nome</label>
            <input type="text" name="nome" id="nome">

            <label>Idade</label>
            <input type="number" name="idade" id="idade">

            <label>RG</label>
            <input type="text" name="rg" id="rg">

            <label>Email</label>
            <input type="email" name="email" id="email">

            <button type="submit">Cadastrar</button>
        </form>
      </section>
   </main>
</body>
</html>
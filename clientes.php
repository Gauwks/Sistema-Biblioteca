<?php  
include_once("conexao.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome   = $_POST['nome'];
    $idade  = $_POST['idade'];
    $rg     = $_POST['rg'];
    $email  = $_POST['email'];

    $sql = "INSERT INTO clientes (nome, idade, rg, email)
            VALUES ('$nome', '$idade', '$rg', '$email')";

    if ($conn->query($sql)) {
        echo "<script>alert('Cliente cadastrado com sucesso!'); window.location='clientes.php';</script>";
        exit;
    } else {
        echo "<script>alert('Erro ao cadastrar: ".$conn->error."');</script>";
    }
}

$lista = $conn->query("SELECT nome, idade, rg, email 
                       FROM clientes 
                       ORDER BY id_cliente DESC 
                       LIMIT 5");
?>
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
    <h1>Últimos clientes cadastrados:</h1>

    <?php if ($lista->num_rows > 0): ?>
        <ul>
            <?php while($c = $lista->fetch_assoc()): ?>
                <li>
                    <strong><?= $c['nome'] ?></strong> – 
                    <?= $c['idade'] ?> anos  
                    — RG: <?= $c['rg'] ?>  
                    — Email: <?= $c['email'] ?>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>Nenhum cliente cadastrado ainda.</p>
    <?php endif; ?>

</section>

<section class="cadastrarCliente">
    <h1>Cadastrar cliente:</h1>

    <form action="clientes.php" method="POST">
        <label>Nome</label>
        <input type="text" name="nome" required>

        <label>Idade</label>
        <input type="number" name="idade" required>

        <label>RG</label>
        <input type="text" name="rg" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <button type="submit">Cadastrar</button>
    </form>
</section>

</main>
</body>
</html>

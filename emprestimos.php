<?php
include_once("conexao.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nomeCliente = $_POST["cliente"];
    $nomeLivro   = $_POST["livro"];
    $dataEmp = $_POST["dtEmprestimo"];
    $dataDev = $_POST["dtDevolucao"];

    $sqlCli = $conn->prepare("SELECT id_cliente FROM clientes WHERE nome LIKE ?");
    $buscaCli = "%$nomeCliente%";
    $sqlCli->bind_param("s", $buscaCli);
    $sqlCli->execute();
    $resCli = $sqlCli->get_result()->fetch_assoc();

    if (!$resCli) {
        echo "<p style='color: red;'>Cliente não encontrado.</p>";
    } else {
        $fkCliente = $resCli["id_cliente"];

        $sqlLiv = $conn->prepare("SELECT id_livro FROM livros WHERE titulo LIKE ?");
        $buscaLiv = "%$nomeLivro%";
        $sqlLiv->bind_param("s", $buscaLiv);
        $sqlLiv->execute();
        $resLiv = $sqlLiv->get_result()->fetch_assoc();

        if (!$resLiv) {
            echo "<p style='color: red;'>Livro não encontrado.</p>";
        } else {
            $fkLivro = $resLiv["id_livro"];

            $sql = "INSERT INTO emprestimo (data_emp, data_devolucao, fk_livro, fk_cliente)
                    VALUES ('$dataEmp', '$dataDev', '$fkLivro', '$fkCliente')";

            if ($conn->query($sql)) {
                echo "<p style='color: green;'>Empréstimo registrado com sucesso!</p>";
            } else {
                echo "<p style='color: red;'>Erro ao registrar: " . $conn->error . "</p>";
            }
        }
    }
}

$lista = $conn->query("
    SELECT e.data_emp, e.data_devolucao, 
           c.nome AS cliente, 
           l.titulo AS livro
    FROM emprestimo e
    JOIN clientes c ON e.fk_cliente = c.id_cliente
    JOIN livros l ON e.fk_livro = l.id_livro
    ORDER BY e.id_emprestimo DESC
    LIMIT 5
");
?>

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

        <?php if ($lista && $lista->num_rows > 0): ?>
            <ul>
                <?php while ($e = $lista->fetch_assoc()): ?>
                    <li>
                        <strong><?= $e["cliente"] ?></strong>
                        pegou <strong><?= $e["livro"] ?></strong><br>
                        Em: <?= date("d/m/Y H:i", strtotime($e["data_emp"])) ?><br>
                        Devolução: <?= date("d/m/Y H:i", strtotime($e["data_devolucao"])) ?>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>Nenhum empréstimo registrado ainda.</p>
        <?php endif; ?>
    </section>

    <section class="cadastrarEmprestimo">
        <h1>Registrar empréstimo:</h1>

        <form action="emprestimos.php" method="POST">

            <label for="cliente">Cliente (nome)</label>
            <input type="text" name="cliente" id="cliente" required>

            <label for="livro">Livro (nome)</label>
            <input type="text" name="livro" id="livro" required>

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

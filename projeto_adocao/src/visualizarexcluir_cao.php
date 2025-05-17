<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Visualizar e Excluir Cão</title>
</head>
<body>
<h1>Visualizar e Excluir Cão</h1>

<?php
// Definição das credenciais de conexão com o banco de dados
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "adocao_luan";

// Criação de uma nova conexão com o banco de dados MySQL
$conn = new mysqli($servidor, $usuario, $senha, $banco);

// Verificação de erro na conexão com o banco de dados
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verificação se o ID do cão foi fornecido na query string
if (isset($_GET["id"])) {
    $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
    if ($id === false) {
        echo "<p>ID inválido.</p>";
    } else {
        // Verificação se o parâmetro 'excluir' foi definido na query string
        if (isset($_GET["excluir"])) {
            // Exclusão do cão com o ID fornecido
            $sql = "DELETE FROM tbl_cao WHERE id = ?";
            $stmt_excluir = $conn->prepare($sql);
            $stmt_excluir->bind_param("i", $id);

            if ($stmt_excluir->execute()) {
                echo "<p>Cão excluído com sucesso.</p>";
            } else {
                echo "<p>Erro ao excluir cão: " . $stmt_excluir->error . "</p>";
            }

            $stmt_excluir->close();
        }

        // Preparação da declaração preparada
        $stmt = $conn->prepare("SELECT * FROM tbl_cao WHERE id = ?");
        $stmt->bind_param("i", $id);

        // Execução da consulta
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificação se o cão foi encontrado
        if ($result->num_rows > 0) {
            // Exibição das informações do cão em um bloco div
            while ($row = $result->fetch_assoc()) {
                echo "<div class='cao'>";
                echo "<h2>" . $row["nome"] . "</h2>";
                echo "<img src='" . $row["imagem"] . "' width='200'><br>";
                echo "<p>Raça: " . $row["raca"] . "</p>";
                echo "<p>Idade: " . $row["idade"] . "</p>";
                echo "<p>Descrição: " . $row["descricao"] . "</p>";
                echo "<a href='visualizarexcluir_cao.php?id=" . $row["id"] . "&excluir=1'>Excluir Cão</a>";
                echo "</div>";
            }
        } else {
            echo "<p>Cão não encontrado.</p>";
        }

        // Fechamento da declaração preparada
        $stmt->close();
    }
} else {
    echo "<p>ID do cão não foi fornecido.</p>";
}

// Fechamento da conexão com o banco de dados
$conn->close();
?>

<a href="listar_cao.php">Voltar para Início</a>

</body>
</html>
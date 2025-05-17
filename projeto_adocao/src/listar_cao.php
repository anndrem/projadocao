<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cães para Adoção</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Cães para Adoção</h1>

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
    // Exibição de mensagem de erro e encerramento do script
    die("Falha na conexão: " . $conn->connect_error);
}

// Consulta SQL para buscar todos os cães não adotados
$sql = "SELECT * FROM tbl_cao WHERE adocao = FALSE";

// Execução da consulta SQL
$result = $conn->query($sql);

// Verificação se foram encontrados resultados
if ($result->num_rows > 0) {
    // Loop para percorrer os resultados
    while ($row = $result->fetch_assoc()) {
        // Exibição das informações do cão em um bloco div
        echo "<div class='cao'>";
        echo "<h2>" . $row["nome"] . "</h2>";
        echo "<img src='" . $row["imagem"] . "' width='200'><br>";
        echo "<p>Raça: " . $row["raca"] . "</p>";
        echo "<p>Idade: " . $row["idade"] . "</p>";
        echo "<p>Descrição: " . $row["descricao"] . "</p>";

        // Link para a página de detalhes do cão
        echo "<a href='detalhes_cao.php?id=" . $row["id"] . "'>Detalhes</a><br><br>";

        // Link para a página de adoção do cão
        echo "<a href='adotar_cao.php?id=" . $row["id"] . "'>Adotar</a><br><br>";

        // Link para a página de visualização e exclusão do cão
        echo "<a href='visualizarexcluir_cao.php?id=" . $row["id"] . "'>Visualizar/Excluir</a>";

        echo "</div>";
    }
} else {
    // Exibição de mensagem se nenhum cão for encontrado
    echo "<p>Não foram encontrados cães para adoção.</p>";
}

// Fechamento da conexão com o banco de dados
$conn->close();
?>

<a href="inicio.php">Voltar para Início</a>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Detalhes do Cão</title>
    <link rel="stylesheet" href="styles/styleDetalhes.css">
</head>
<body>

<h1>Detalhes do Cão</h1>

<?php
$servidor = "localhost"; // Endereço do servidor MySQL
$usuario = "root"; // Nome de usuário do MySQL
$senha = ""; // Senha do MySQL
$banco = "adocao_luan"; // Nome do banco de dados

$conn = new mysqli($servidor, $usuario, $senha, $banco); // Cria uma nova conexão com o banco de dados

if ($conn->connect_error) { // Verifica se houve erro na conexão
    die("Falha na conexão: " . $conn->connect_error); // Exibe a mensagem de erro e encerra o script
}

$id = $_GET["id"]; // Obtém o ID do cão da query string

$sql = "SELECT * FROM tbl_cao WHERE id = $id"; // Consulta SQL para buscar o cão pelo ID
$result = $conn->query($sql); // Executa a consulta SQL

echo "<div class='container'>";
if ($result->num_rows > 0) { // Verifica se o cão foi encontrado
    $row = $result->fetch_assoc(); // Obtém os dados do cão em um array associativo
    echo "<div class='cao'>"; // Início de um bloco div para exibir os detalhes do cão
    echo "<div class='nome'>";
    echo "<h2>" . $row["nome"] . "</h2>"; // Exibe o nome do cão
    echo "</div>";

    echo "<img src='" . $row["imagem"] . "' width='200'>"; // Exibe a imagem do cão
    
    echo "<div class='info'>";
    echo "<p>Raça: " . $row["raca"] . "</p>"; // Exibe a raça do cão
    echo "<p>Idade: " . $row["idade"] . "</p>"; // Exibe a idade do cão
    echo "<p>Descrição: " . $row["descricao"] . "</p>"; // Exibe a descrição do cão
    echo "</div>";
    if ($row["adocao"] == 0) { // Verifica se o cão foi adotado
        echo "<div class='desc'>";
        echo "<a href='adotar_cao.php?id=" . $row["id"] . "'>Adotar</a>"; // Link para adotar o cão
        echo "</div>";
    } else {
        echo "<p>Este cão já foi adotado.</p>"; // Mensagem se o cão já foi adotado
    }
    echo "</div>"; // Fecha o bloco div
} else {
    echo "<p>Cão não encontrado.</p>"; // Mensagem se o cão não for encontrado
}
echo "</div>";

$conn->close(); // Fecha a conexão com o banco de dados
?>
<div class="botoes">
<a href="listar_cao.php">Voltar para a lista</a><br>
<a href="index.php">Voltar para Início</a>
</div>
</body>
</html>
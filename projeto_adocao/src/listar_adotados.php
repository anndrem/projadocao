<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/styleListarAdotados.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cães Adotados</title>
</head>
<body>
    <div class="titulo"><h1>Cães Adotados</h1></div>
<?php
$servidor = "localhost"; // Endereço do servidor MySQL
$usuario = "root";       // Nome de usuário do MySQL
$senha = "";             // Senha do MySQL
$banco = "adocao_luan";    // Nome do banco de dados

$conn = new mysqli($servidor, $usuario, $senha, $banco); // Cria uma nova conexão com o banco de dados

if ($conn->connect_error) { // Verifica se houve erro na conexão
    die("Falha na conexão: " . $conn->connect_error); // Exibe a mensagem de erro e encerra o script
}

$sql = "SELECT * FROM tbl_cao WHERE adocao = TRUE AND adocao = 1"; // Consulta SQL para buscar cães adotados
$result = $conn->query($sql); // Executa a consulta SQL

if ($result->num_rows > 0) { // Verifica se foram encontrados resultados
    echo "<div class='container'>";
    while ($row = $result->fetch_assoc()) { // Loop para percorrer os resultados
        echo "<div class='cao'>";
        echo "<div class='nome'>";
        echo "<h2>" . $row["nome"] . "</h2>"; // Exibe o nome do cão
        echo "</div>";

        echo "<img src='" . $row["imagem"] . "' width='200'><br>"; // Exibe a imagem do cão
        echo "<div class='info'>";
        echo "<p>Raça: " . $row["raca"] . "</p>"; // Exibe a raça do cão
        echo "<p>Idade: " . $row["idade"] . "</p>"; // Exibe a idade do cão
        echo "<p>Descrição: " . $row["descricao"] . "</p>"; // Exibe a descrição do cão
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<p>Nenhum cão foi adotado ainda.</p>"; // Mensagem se nenhum cão foi adotado
}

$conn->close(); // Fecha a conexão com o banco de dados
?>

<div class="botoes">
<a href="pag_user.php">Voltar para Início</a>
</div>

</body>
</html>
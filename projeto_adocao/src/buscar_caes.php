<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Buscar Cães</title>
</head>
<body>
    <h1>Buscar Cães</h1>
    <form action="buscar_caes.php" method="post">
        <input type="text" name="nome" placeholder="Digite o nome ou raça">
        <input type="submit" value="Buscar">
    </form>

<?php
// Conexão com o banco de dados
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "adocao_luan";

// Criar conexão com o banco de dados
$conn = new mysqli($host, $user, $pass, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["nome"])) {
        $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);

        // Consulta SQL para buscar cães por nome ou raça
        $sql = "SELECT * FROM tbl_cao WHERE nome LIKE ? OR raca LIKE ?";
        $stmt = $conn->prepare($sql);
        $nome_param = "%" . $nome . "%";
        $stmt->bind_param("ss", $nome_param, $nome_param);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<h2>" . $row["nome"] . "</h2>";
                echo "<p>Raça: " . $row["raca"] . "</p>";
                echo "<p>Idade: " . $row["idade"] . "</p>";
                echo "<img src='" . $row["imagem"] . "' alt='Imagem do cão' width='200'><br>";
                echo "<a href='adotar_cao.php?id=" . $row["id"] . "'>Adotar</a><hr>";
            }
        } else {
            echo "<p>Nenhum cão foi encontrado</p>";
        }

        $stmt->close(); // Fecha a declaração preparada
    } else {
        echo "<p>Por favor, preencha o campo de busca</p>";
    }
}

$conn->close(); // Fecha a conexão com o banco de dados
?>

<a href="index.php">Voltar para o início</a>
</body>
</html>
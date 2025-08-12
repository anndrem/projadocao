<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Buscar Cães</title>
    <link rel="stylesheet" href="styles/buscar.css">
</head>
<body>
    <div class="titulo">
        <h1>Buscar Cães</h1>
    </div>
    <div class="busca">
        <form action="buscar_caes.php" method="post">
            <input type="text" name="nome" placeholder="Digite o nome ou raça">
            <input class="bottom" type="submit" value="Buscar">
        </form>
    </div>

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
            echo "<div class='container'>";
            while ($row = $result->fetch_assoc()) {
                echo "<div class='cao'>";
                echo "<div class='nome'>";
                echo "<h2>" . $row["nome"] . "</h2>";
                echo "</div>";

                echo "<img src='" . $row["imagem"] . "' alt='Imagem do cão' width='200'><br>";

                echo "<div class='info'>";
                echo "<p>Raça: " . $row["raca"] . "</p>";
                echo "<p>Idade: " . $row["idade"] . "</p>";
                echo "<p>Descrição: " . $row["descricao"] . "</p>";
                echo "</div>";
                
                if ($row["adocao"] == 0) { // Verifica se o cão foi adotado
                echo "<div class='desc'>";
                echo "<a href='adotar_cao.php?id=" . $row["id"] . "'>Adotar</a>"; // Link para adotar o cão
                echo "</div>";
                    } else {
                        echo "<div class='jaadotado'><p>Este cão já foi adotado.</p></div>"; // Mensagem se o cão já foi adotado
                        }

                echo "</div>";
            }
            echo "</div>";

        } else {
            echo "<div class='erros'>";
            echo "<p>Nenhum cão foi encontrado.</p>";
            echo "</div>";
        }

        $stmt->close(); // Fecha a declaração preparada
    } else {
        echo "<div class='porfavor'>";
        echo "<p>Por favor, preencha o campo de busca</p>";
        echo "</div>";
    }
}
echo "<div class='espaco'></div>";

$conn->close(); // Fecha a conexão com o banco de dados
?>

<div class="botoes"><a href="index.php">Voltar para o início</a></div>
</body>
</html>
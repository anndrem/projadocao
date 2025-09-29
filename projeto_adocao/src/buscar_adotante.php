<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Buscar Adotantes</title>
    <link rel="stylesheet" href="styles/styleBuscaradotante.css">
</head>
<body>
    <div class="titulo">
        <h1>Buscar Adotantes</h1>
    </div>
    <div class="busca">
        <form action="buscar_adotante.php" method="post">
            <input type="text" name="nome" placeholder="Digite o nome do adotante">
            <input class="bottom" type="submit" value="Buscar">
        </form>
    </div>

<?php
// Conexão com o banco de dados
require "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["nome"])) {
        $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);

        // Consulta SQL para buscar cães por nome ou raça
        $sql = "SELECT * FROM tbl_adotantes WHERE nome LIKE ?";
        $stmt = $conn->prepare($sql);
        $nome_param = "%" . $nome . "%";
        $stmt->bind_param("s", $nome_param);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            
            while ($row = $result->fetch_assoc()) {
                echo "<div class='container'>";
                    echo "<div class='junto'>";
                        echo "<div class='nome'>";
                        echo "<h2>" . $row["nome"] . "</h2>";
                         echo "</div>";
    
                    echo "<div class='adotante'>"; 

                        echo "<div class='info'>";
                        echo "<p>Email: " . $row["email"] . "</p>";
                        echo "<p>Telefone: " . $row["telefone"] . "</p>";
                        echo "<p>Contato: " . $row["contato"] . "</p>";
                        echo "<p>Experiência: " . $row["experiencia"] . "</p>";
                        echo "<p>Residência: " . $row["residencia"] . "</p>";
                        echo "</div>";

                    echo "</div>";
                    echo "<div class='imgs'>";
                        echo "<img src='imgs_adotantes/" . $row["foto_adotante"] . "' width='300' height='320'>";
                        echo "<img src='imgs_adotantes/" . $row["foto_residencia"] . "' width='300' height='320'>";
                    echo "</div>";
  
                    echo "</div>";
                echo "</div>";
                }

        }else {
            echo "<div class='erros'>";
            echo "<p>Nenhum adotante foi encontrado.</p>";
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
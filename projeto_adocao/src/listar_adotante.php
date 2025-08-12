<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Adotantes</title>
    <link rel="stylesheet" href="styles/styleListarAdotante.css">
</head>
<body>
<?php
$conn = new mysqli("localhost", "root", "", "adocao_luan");
$result = $conn->query("SELECT * FROM tbl_adotantes");

echo "<div class='titulo'>";
echo "<h1>Lista de Adotantes</h1>";
echo "</div>";

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
?>
<div class="botoes">
<a href="index.php">Voltar para Início</a>
</div>
</body>
</html>
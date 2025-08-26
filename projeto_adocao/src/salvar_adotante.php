<head>
    <meta charset="UTF-8">
    <title>Salvar Cão</title>
    <link rel="stylesheet" href="styles/styleSalvaradotante.css">
</head>
<?php
require "conexao.php";

// Upload de imagens
$foto1 = $_FILES["foto_adotante"]["name"];
$foto2 = $_FILES["foto_residencia"]["name"];
move_uploaded_file($_FILES["foto_adotante"]["tmp_name"], "imgs_adotantes/" . $foto1);
move_uploaded_file($_FILES["foto_residencia"]["tmp_name"], "imgs_adotantes/" . $foto2);

$sql = "INSERT INTO tbl_adotantes (nome, email, telefone, contato, experiencia, residencia, foto_adotante, foto_residencia)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", 
    $_POST["nome"], $_POST["email"], $_POST["telefone"], 
    $_POST["contato"], $_POST["experiencia"], $_POST["residencia"],
    $foto1, $foto2
);
$stmt->execute();

echo "<div class='sucesso'>Adotante cadastrado com sucesso!</div>";
?>
<a href="form_adotante.php">Voltar para o Início</a>
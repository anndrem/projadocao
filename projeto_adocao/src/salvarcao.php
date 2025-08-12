<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Salvar Cão</title>
    <link rel="stylesheet" href="styles/styleSalvar.css">
</head>
<body>
    <h1>Cadastrar Cão</h1>

<?php
// Dados da conexão com o banco de dados
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "adocao_luan";

// Criar conexão com o banco de dados MySQL
$conn = new mysqli($host, $user, $pass, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Dados do formulário
$nome = $_POST["nome"];
$raca = $_POST["raca"];
$idade = $_POST["idade"];
$descricao = $_POST["descricao"];

// Obtenção do arquivo de imagem enviado pelo formulário
$imagem = $_FILES["imagem"];

// Validação do tipo de imagem
$allowed_types = ["image/jpeg", "image/jpg", "image/png"];
$max_size = 2 * 1024 * 1024;

if (!in_array($imagem["type"], $allowed_types)) {
    echo "<div class='erros'>Tipo de imagem não permitido. Apenas JPEG, JPG e PNG são permitidos.</div>";
    echo"<a href='cadastrarcao.php'>Voltar para o Início</a>";
    exit;
}

if ($imagem["size"] > $max_size) {
    echo "<div class='erros'>O tamanho da imagem é muito grande. O tamanho máximo permitido é 2MB.</div>";
    echo"<a href='cadastrarcao.php'>Voltar para o Início</a>";
    exit;
}


// Criação do diretório "imgs" se ele não existir
if (!file_exists("imgs")) {
    mkdir("imgs");
}

// Definição do caminho para salvar a imagem
$caminho_imagem = "imgs/" . $imagem["name"];

// Movimentação da imagem do temp para o diretório de destino
if (move_uploaded_file($imagem["tmp_name"], $caminho_imagem)) {

// Sanitização dos dados antes de inserção no banco
$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
$raca = filter_input(INPUT_POST, "raca", FILTER_SANITIZE_STRING);
$idade = filter_input(INPUT_POST, "idade", FILTER_VALIDATE_INT);
$descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_STRING);

// Verificação dos dados do formulário
if (empty($nome)) {
    echo "Nome é obrigatório.";
    exit;
}

if ($idade === false) {
    echo "Idade deve ser um número inteiro.";
    exit;
}

// Preparo da consulta SQL para inserir os dados do cão
$sql = "INSERT INTO tbl_cao (nome, raca, idade, descricao, imagem) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Vinculação dos parâmetros à consulta preparada
$stmt->bind_param("ssiss", $nome, $raca, $idade, $descricao, $caminho_imagem);

// Execução da consulta
if ($stmt->execute()) {
    echo "<div class='sucesso'>Cão cadastrado com sucesso!</div>";
} else {
    echo "<div class='erros'>Erro ao cadastrar cão: </div>" . $stmt->error;
}

// Fechamento da declaração preparada
$stmt->close();
 } else {
    echo "Erro ao fazer upload da imagem.";
}
$conn->close();
?>
<br><a href="cadastrarcao.php">Voltar para o Início</a>
</body>
</html>
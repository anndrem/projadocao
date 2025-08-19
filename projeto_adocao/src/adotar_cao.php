<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cães para adoção</title>
    <link rel="stylesheet" href="styles/styleAdotado.css">
</head>
<body>
    <h1>Cães para adoção</h1>
    <?php
    $servername = "localhost"; //Endereço do servidor mysql
    $usuario = "root"; //nome de usuario do mysql
    $senha = "usbw"; //senha do mysql
    $dbname = "adocao_luan"; //nome do banco de dados

    $conn = new mysqli("localhost", "root", "", "adocao_luan"); // cria uma nova conexao com banco de dados

    if ($conn->connect_error) { //verifica se houve erro na conexao
        die("Falha na conexao: " . $conn->connect_error); // exibe mensagem de erro e encerra o script
    }

    $id = $_GET["id"]; //obtem o id do cao da query string

    $sql = "UPDATE tbl_cao SET adocao = TRUE WHERE id = $id"; //consulta sql para marcar o cao como adotado

    echo   "<div class='sucesso'>";
    if ($conn->query($sql) === TRUE) { //executa a consulta mysql e verifica se foi bem sucedida
        echo "Cão adotado com sucesso!"; //exibe mensagem de sucesso
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error; //exibe mensagem de erro
    }
    echo "</div>";
    $conn->close(); //fecha a conexao com o banco de dados
    ?>
    <br><a href="pag_user.php">Voltar para o Início</a>
</body>
</html>
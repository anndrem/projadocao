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

    use Soap\Url;

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

   
    // Validação da imagem principal
    if (!in_array($imagem["type"], $allowed_types)) {
        echo "<div class='erros'>Tipo de imagem não permitido. Apenas JPEG, JPG e PNG são permitidos.</div>";
        echo "<a href='cadastrarcao.php'>Voltar para o Início</a>";
        exit;
    }
    if ($imagem["size"] > $max_size) {
        echo "<div class='erros'>O tamanho da imagem é muito grande. O tamanho máximo permitido é 2MB.</div>";
        echo "<a href='cadastrarcao.php'>Voltar para o Início</a>";
        exit;
    }

    if (!file_exists("imgs")) {
        mkdir("imgs");
    }
    $caminho_imagem = "imgs/" . uniqid() . "_" . basename($imagem["name"]);

    if (move_uploaded_file($imagem["tmp_name"], $caminho_imagem)) {
        $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
        $raca = filter_input(INPUT_POST, "raca", FILTER_SANITIZE_STRING);
        $idade = filter_input(INPUT_POST, "idade", FILTER_VALIDATE_INT);
        $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_STRING);

        if (empty($nome)) {
            echo "Nome é obrigatório.";
            exit;
        }
        if ($idade === false) {
            echo "Idade deve ser um número inteiro.";
            exit;
        }

        $sql = "INSERT INTO tbl_cao (nome, raca, idade, descricao, imagem) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiss", $nome, $raca, $idade, $descricao, $caminho_imagem);

        if ($stmt->execute()) {
            echo "<div class='sucesso'>Cão cadastrado com sucesso!</div>";
            $id_cao = $stmt->insert_id;
            $stmt->close();

            // Processa fotos adicionais
            if (isset($_FILES["fotos"]) && count($_FILES["fotos"]["name"]) > 0 && $_FILES["fotos"]["name"][0] != "") {
                $upload_dir = "imgs/";
                foreach ($_FILES["fotos"]["name"] as $key => $name) {
                    $tmp_name = $_FILES["fotos"]["tmp_name"][$key];
                    $type = $_FILES["fotos"]["type"][$key];
                    $size = $_FILES["fotos"]["size"][$key];
                    $error = $_FILES["fotos"]["error"][$key];

                    if ($error === UPLOAD_ERR_OK) {
                        if (in_array($type, $allowed_types) && $size <= $max_size) {
                            $caminho_foto = $upload_dir . uniqid() . "_" . basename($name);
                            if (move_uploaded_file($tmp_name, $caminho_foto)) {
                                $sql_galeria = "INSERT INTO galeria_caes(id_cao, caminho_imagem) VALUES (?, ?)";
                                $stmt_galeria = $conn->prepare($sql_galeria);
                                $stmt_galeria->bind_param("is", $id_cao, $caminho_foto);
                                $stmt_galeria->execute();
                                $stmt_galeria->close();
                            } else {
                                echo "Erro ao mover o arquivo " . $name . "<br>";
                            }
                        } else {
                            echo "Arquivo " . $name . " inválido ou muito grande<br>";
                        }
                    } else {
                        echo "Erro no upload do arquivo " . $name . " com código " . $error . "<br>";
                    }
                }
                echo "Cão e galeria de fotos cadastrados com sucesso!";
            } else {
                echo "Cão cadastrado, mas nenhuma imagem adicional foi enviada.";
            }
        } else {
            echo "<div class='erros'>Erro ao cadastrar cão: </div>" . $stmt->error;
        }
    } else {
        echo "Erro ao fazer upload da imagem.";
    }
    $conn->close();

    ?>
    <br><a href="cadastrarcao.php">Voltar para o Início</a>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <title>Detalhes do Cão</title>
    <link rel="stylesheet" href="styles/styleDetalhes.css">
</head>

<body>

    <h1>Detalhes do Cão</h1>

    <?php
    require "conexao.php";
    $id = $_GET["id"]; // Obtém o ID do cão da query string


    $sql = "SELECT c.id, c.nome, c.raca, c.idade, c.descricao, c.imagem, c.adocao, g.caminho_imagem as g_img FROM galeria_caes  g join tbl_cao c on g.id_cao = c.id WHERE id_cao = $id";
    $result = $conn->query($sql); // Executa a consulta SQL

    echo "<div class='container'>";
    if ($result->num_rows > 0) { // Verifica se o cão foi encontrado
        $row = $result->fetch_assoc(); // Obtém os dados do cão em um array associativo
        echo "<div class='cao'>"; // Início de um bloco div para exibir os detalhes do cão
        echo "<div class='nome'>";
        echo "<h2>" . $row["nome"] . "</h2>"; // Exibe o nome do cão
        echo "</div>";

        echo "<img src='" . $row["imagem"] . "' width='200'>"; // Exibe a imagem do cão
        if (!empty($row["g_img"])) {
         foreach($result as $row) {
            echo "<img src='" . $row["g_img"] . "' width='200'>"; // Exibe a imagem da galeria do cão
         }   
        }
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
        <script src="./scripts/popup.js"></script>
    </div>
</body>

</html>
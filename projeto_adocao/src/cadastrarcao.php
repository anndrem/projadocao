<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styleCadastrarcao.css">
    <title>Cadastrar</title>
</head>
<body>
    <div class="header">
        <h1>Cadastrar cão</h1>
    </div>
    <div class="container">
    <form action="salvarcao.php" method="post" enctype="multipart/form-data">
        <label for="nome">Nome:</label><br>
        <input class="campos" type="text" name="nome" placeholder="Mike"><br><br>

        <label for="raca">Raça:</label><br>
        <input class="campos" type="text" name="raca" placeholder="Dalmata"><br><br>

        <label for="idade">Idade:</label><br>
        <input class="campos" type="number" name="idade" placeholder="12"><br><br>

        <label for="descricao">Descrição:</label><br>
        <textarea name="descricao"></textarea><br><br>

        <label for="imagem">Foto do cão:</label><br>
        <input class="imagem" type="file" name="imagem"><br><br>
    
        <label for="imagem">Galeria</label><br>
        <input class="imagem" type="file" name="fotos[]" multiple><br><br>

        <input class="botao" type="submit" value="Cadastrar"><br><br>
    </form>
    </div>
    <br><a href="index.php">Voltar para o início</a>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Cadastrar cão</h1>
    <form action="salvarcao.php" method="post" enctype="multipart/form-data">
        <label for="nome">Nome:</label><br>
        <input type="text" name="nome"><br><br>
        <label for="raca">Raça:</label><br>
        <input type="text" name="raca"><br><br>
        <label for="idade">Idade:</label><br>
        <input type="number" name="idade"><br><br>
        <label for="descricao">Descrição:</label><br>
        <textarea name="descricao"></textarea><br><br>
        <label for="imagem">Imagem:</label><br>
        <input type="file" name="imagem"><br><br>
        <input type="submit" value="Cadastrar"><br><br>
    </form>
    <br><a href="inicio.php">Voltar para o início</a>
</body>
</html>
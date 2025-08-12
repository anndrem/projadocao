<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Adotante</title>
  <link rel="stylesheet" href="styles/styleCadastroadotante.css">
</head>
<body>
    <div class="header">
        <h1>Cadastro de Adotante</h1>
    </div>
    <div class="container">
        <form action="salvar_adotante.php" method="POST" enctype="multipart/form-data">
            <label>Nome:</label><br>
            <input class ="campos" type="text" name="nome" placeholder="Lucas André" required><br>

            <label>Email:</label><br>
            <input class ="campos" type="email" name="email" placeholder="lucas@gmail.com" required><br>

            <label>Telefone:</label><br>
            <input class ="campos" type="text" id="telefone" name="telefone" placeholder="(11) 91234-5678" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required><br>

            <label>Informações de Contato:</label><br>
            <textarea name="contato" required></textarea><br>

            <label>Experiência com Animais:</label><br>
            <textarea name="experiencia" required></textarea><br>

            <label>Condições de Residência:</label><br>
            <textarea name="residencia" required></textarea><br>

            <label>Foto do Adotante:</label><br>
            <input class="imagem" type="file" name="foto_adotante" accept="image/*" required><br>

            <label>Foto da Residência:</label><br>
            <input class="imagem" type="file" name="foto_residencia" accept="image/*" required><br><br>

            <button class="botao" type="submit">Cadastrar</button>
        </form>
    </div>

<div class="botoes">
<a href="index.php">Voltar para Início</a>
</div>

<script>
    $(document).ready(function() {
      $('#telefone').inputmask('(99) 99999-9999');
    });
</script>

</body>
</html>
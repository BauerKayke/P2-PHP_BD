<?php
  if (!isset($_GET["id"]) || !isset($_GET["type"])) {
    return header('Location: http://localhost/pages/admin');
  }
  $type = $_GET["type"];
  $id = $_GET["id"];
  $conexao = mysqli_connect("localhost", "root", "", "popflix") or die("Falha de conexão");
  $tabela;
  $text;
  if ($type == 1) {
    $tabela = mysqli_query($conexao, "SELECT * FROM series WHERE id = $id");
    $text = "série";
  } else if ($type == 0) {
    $tabela = mysqli_query($conexao, "SELECT * FROM filmes  WHERE id = $id");
    $text = "filme";
  }

  $linha = mysqli_fetch_array($tabela);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="../../styles/style.css" />
  <link rel="stylesheet" href="../../styles/form.css" />
  <link rel="stylesheet" href="../../styles/header.css">
  
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

  <title>Alterar <?php echo $text ?></title>
</head>
<body>
  <?php include '../../components/adminHeader.php'; ?>

  <section>
    <form action="<?php echo '../../server/editaFilmeSerie.php?id='.$id.'&type='.$type?>" method="post" enctype="multipart/form-data">
      <legend>Alterar <?php echo $text ?></legend>

      <div class="div-input">
        <label for="user">Nome </label>
        <br />
        <input type="text" name="nome" placeholder="Digite o nome do filme ou série" required value="<?php echo $linha['nome']?>" />
      </div>
      <br />
      <div class="div-input">
        <label for="descricao">Descrição </label>
        <br />
        <input type="text" name="descricao" placeholder="Digite a descrição do filme" required value="<?php echo $linha['descricao']?>" />
      </div>
      <br />
      <div class="div-input">
        <label for="img">Caminho imagem </label>
        <br />
        <input type="text" name="img" placeholder="Digite o caminho da imagem" required value="<?php echo $linha['caminho_img']?>" />
      </div>
      <br />
      <div class="div-input">
        <label for="valor">valor </label>
        <br />
        <input type="text" name="valor" placeholder="Digite o valor" required value="<?php echo $linha['valor']?>"/>
      </div>
      <br />
      <div class="div-input">
        <?php if($type ==0): ?>
          <label for="tamanho">Duração (min) </label>
          <input type="number" name="tamanho" placeholder="Digite a duração do filme" required value="<?php echo $linha['tamanho']?>"/>
        <?php else: ?>
          <label for="tamanho">Temporadas </label>
          <input type="number" name="tamanho" placeholder="Digite o número de temporadas" required value="<?php echo $linha['tamanho']?>"/>
        <?php endif; ?>
        <br />
      </div>
      <br />
      <br />
      <hr />
      <br />
      <div class="div-input">
        <label for="button" class="button">
          <button type="submit">Alterar</button>
        </label>
      </div>
    </form>
  </section>
</body>
</html>
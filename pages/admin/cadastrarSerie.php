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

  <title>Cadastrar série</title>
</head>
<body>
  <?php include '../../components/adminHeader.php'; ?>

  <section>
    <form action="../../server/cadastroFilmeSerie.php?type=1" method="post" enctype="multipart/form-data">
      <legend>Cadastro de séries</legend>
      <div class="div-input">
        <label for="user">Nome </label>
        <br />
        <input type="text" name="nome" placeholder="Digite o nome da série" required />
      </div>
      <br />
      <div class="div-input">
        <label for="descricao">Descrição </label>
        <br />
        <input type="text" name="descricao" placeholder="Digite a descrição da série" required />
      </div>
      <br />
      <div class="div-input">
        <label for="img">Caminho imagem </label>
        <br />
        <input type="text" name="img" placeholder="Digite o caminho da imagem" required />
      </div>
      <br />
      <div class="div-input">
        <label for="valor">valor </label>
        <br />
        <input type="text" name="valor" placeholder="Digite o valor" required />
      </div>
      <br />
      <div class="div-input">
        <label for="tamanho">Temporadas </label>
        <br />
        <input type="number" name="tamanho" placeholder="Digite a duração da série" required />
      </div>
      <br />
      <br />
      <hr />
      <br />
      <div class="div-input">
        <label for="button" class="button">
          <button type="submit">Cadastrar</button>
        </label>
      </div>
    </form>
  </section>
</body>
</html>
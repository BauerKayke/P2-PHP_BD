<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="../styles/form.css" />
  <link rel="stylesheet" href="../styles/style.css" />
  
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet" />

  <script src="../scripts/form.js"></script>
  <script src="../scripts/cart.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

  <title>Cadastrar usuário</title>
</head>

<body>
  <section>
    <form action="../server/cadastro.php" method="post" enctype="multipart/form-data">
      <legend>Cadastro de usuário</legend>
      <div class="div-input">
        <label for="user">Usuário </label>
        <br />
        <input type="text" name="user" placeholder="Digite seu usuário" required />
      </div>
      <br />
      <div class="div-input">
        <label for="nome">Nome </label>
        <br />
        <input type="text" name="nome" placeholder="Digite seu nome completo" required />
      </div>
      <br />
      <div class="div-input">
        <label for="email">E-mail </label>
        <br />
        <input type="email" name="email" placeholder="Digite seu email" required />
      </div>
      <br />
      <div class="div-input">
        <label for="password">Senha </label>
        <br />
        <input type="password" name="password" placeholder="Digite uma senha" required id="password" />
      </div>
      <br />
      <div class="div-input">
        <label for="re-password">Repita a Senha </label>
        <br />
        <input type="password" name="re-password" placeholder="Repita a senha" required id="re-password" />
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
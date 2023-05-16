<?php
  session_cache_expire(10);
  session_start();

  if(!isset($_SESSION["login"]) || $_SESSION["login"] != true) {
    header("Location: /pages/login.php");
  }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="../styles/cart.css" />
  <link rel="stylesheet" href="../styles/style.css" />
  <link rel="stylesheet" href="../styles/header.css" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet" />

  <script src="../scripts/cart.js"></script>

  <title>PopFlix - Carrinho</title>
</head>

<body onload="cartUpdate()">
  <?php
  if (isset($_GET['key']) && isset($_GET['value'])) {
    setcookie($_GET['key'], $_GET['value'], time() + 1800); // expira em 1 hora
  }

  include '../components/header.php';
  ?>
  <section id='container'>
    <section id='items'>
      <?php
      $conexao = mysqli_connect("localhost", "root", "", "popflix") or die("Falha de conexão");

      $tabela;
      $total = 0;

      foreach ($_COOKIE as $key => $ids) {
        if($ids == "onCartFilm") {
          $tabela = mysqli_query($conexao, "SELECT * FROM filmes WHERE id = $key");
          while($linhas = mysqli_fetch_array($tabela)) {
            $id = $linhas["id"];
            $poster_path = $linhas["caminho_img"];
            $title = $linhas["nome"];
            $price = "R$".number_format($linhas["valor"], 2, ',', '.');
            $total += $linhas["valor"];
            include '../components/cartItem.php';
          }
        }
      }

      foreach ($_COOKIE as $key => $ids) {
        if($ids == "onCartSerie") {
          $tabela = mysqli_query($conexao, "SELECT * FROM series WHERE id = $key");
          while($linhas = mysqli_fetch_array($tabela)) {
            $id = $linhas["id"];
            $poster_path = $linhas["caminho_img"];
            $title = $linhas["nome"];
            $price = "R$".number_format($linhas["valor"], 2, ',', '.');
            $total += $linhas["valor"];
            include '../components/cartItem.php';
          }
        }
      }

      $atribute = null;
      if ($total == 0) {
        echo "<div class='cart-item'>
        <div class='item-img'>Nada por aqui...
        </div>";
        $atribute = 'disabled';
      }
      ?>
    </section>
    <section id='price'>
      <div class="total-price">
        <label for="price">
          Preço total:
        </label>
        <?php
        echo "R$".number_format($total, 2, ',', '.');
        ?>
        <form action="../pages/rentForm.php">
          <input type='submit' value='Alugar' <?php echo $atribute ?>>
          </input>
        </form>
      </div>
    </section>
  </section>
</body>

</html>

<?php	mysqli_close($conexao);
<script src="../scripts/details.js"></script>
<link rel="stylesheet" href="../styles/details.css" />
<link rel="stylesheet" href="../styles/dataLoad.css" />
<section id="container">
  <?php
    $conexao = mysqli_connect("localhost", "root", "", "popflix") or die("Falha de conexão");

    $tabela;

    if($type == 1) {
      $tabela = mysqli_query($conexao, "SELECT * FROM series");
    } else if($type == 0){
      $tabela = mysqli_query($conexao, "SELECT * FROM filmes");
    }

    $i = 0;
    $detailId = 1;
    while($linhas = mysqli_fetch_array($tabela)) {
      if ($i == 0) {
        echo "<div class='movies-rows' id='row$detailId'>";
      }
      include 'elementMovie.php';
      $i++;
      if ($i == 5) {
        echo "</div>";
        $i = 0;
        $detailId++;
      }
    }
    if ($i != 0) {
      echo "</div>";
    }
  ?>
  <script>
    let onCartType
    
    <?php if($type == 1): ?>
      onCartType = "onCartSerie"
    <?php else: ?>
      onCartType = "onCartFilm"
    <?php endif; ?>
        
    for (let i = 0; i < localStorage.length; i++) {
      let movie
      if(localStorage[localStorage.key(i)] == onCartType) {
        movie = document.getElementById(localStorage.key(i));
      }
      if(movie) {
        try {
          movie.classList.add('oncart');
        } catch (error) {
          console.log(error);
        }
      }
    }
  </script>
</section>

<?php mysqli_close($conexao) ?>
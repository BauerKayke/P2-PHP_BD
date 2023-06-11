<?php
  $conexao = mysqli_connect("localhost", "root", "", "popflix") or die("Falha de conexão");
  $tabela = mysqli_query($conexao, "SELECT * FROM series");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="../../styles/style.css" />
  <link rel="stylesheet" href="../../styles/header.css">
  <link rel="stylesheet" href="../../styles/selectData.css">
  
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

  <title>Selecionar série</title>
</head>
<body>
  <?php include '../../components/adminHeader.php'; ?>

  <section>
    <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>Nome</th>
          <th>Img</th>
          <th>Valor</th>
          <th>Temporadas</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
          while($linhas = mysqli_fetch_array($tabela)) {
            echo "<tr>";
            echo "<td>".$linhas["id"]."</td>";
            echo "<td>".$linhas["nome"]."</td>";
            echo "<td><img class='img' src='".$linhas["caminho_img"]."' /></td>";
            echo "<td>".$linhas["valor"]."</td>";
            echo "<td>".$linhas["tamanho"]."</td>";
            echo "<td><a href='./edit.php?id=".$linhas["id"]."&type=1'><img src='/img/edit.png'/></a></td>";
            echo "<td><a href='/server/deletaFilmeSerie.php?id=".$linhas["id"]."&type=1'><img src='/img/delete.png'/></a></td>";
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
  </section>
</body>
</html>
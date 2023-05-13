<?php
    if(!isset($_GET["id"]) || !isset($_GET["type"])) {
        return header('Location: http://localhost/');
    }
    $conexao = mysqli_connect("localhost", "root", "", "popflix") or die("Falha de conexão");
    $id = $_GET["id"];
    $type = $_GET["type"];

    $tabela;

    if($type == 1) {
        $tabela = mysqli_query($conexao, "SELECT * FROM series WHERE id = $id");
    } else if($type == 0){
        $tabela = mysqli_query($conexao, "SELECT * FROM filmes  WHERE id = $id");
    }

    $linha = mysqli_fetch_array($tabela);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="../styles/style.css" />
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/detail.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&family=PT+Sans&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet" />

    <script src="../scripts/cart.js"></script>
    <title><?php echo $linha["nome"]?></title> 
</head>
<body onload="cartUpdate()">
    <?php include '../components/header.php' ?>
    <section id="container-detail">
        <img src="<?php echo 'https://image.tmdb.org/t/p/w220_and_h330_face'.$linha['caminho_img']?>" alt="<?php echo $linhas['nome'] ?>">
    </section>
</body>
</html>
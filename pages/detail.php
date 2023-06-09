<?php
session_cache_expire(10);
session_start();

if (!isset($_SESSION["login"]) || $_SESSION["login"] != true) {
    header("Location: http://localhost/pages/login.php");
}

if (!isset($_GET["id"]) || !isset($_GET["type"])) {
    return header('Location: http://localhost/');
}
$conexao = mysqli_connect("localhost", "root", "", "popflix") or die("Falha de conexão");
$id = $_GET["id"];
$type = $_GET["type"];

$tabela;

if ($type == 1) {
    $tabela = mysqli_query($conexao, "SELECT * FROM series WHERE id = $id");
} else if ($type == 0) {
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
    <link rel="stylesheet" href="../styles/details.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&family=PT+Sans&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet" />

    <script src="../scripts/cart.js"></script>
    <title><?php echo $linha["nome"] ?></title> 
</head>
<body onload="cartUpdate()">
    <?php include '../components/header.php' ?>
    
    <section id="container-detail">
        <div class="arrow-box">
            <a href="#row" style="text-decoration: none">
                <label for="left-arrow" class="left-arrow" onclick="">&#8617;</label>
            </a>
        </div>
        <img src="<?php echo 'https://image.tmdb.org/t/p/w220_and_h330_face' . $linha['caminho_img'] ?>" alt="<?php echo $linhas['nome'] ?>">
        <div class="infos">
            <div>
                <h2><?php echo $linha["nome"] ?></h2>
                <p><?php echo $linha["descricao"] ?></p>
            </div>
            <div class="button">
                <a href="#row<?php echo $linha["id"] ?>" style="text-decoration: none">
                    <button class="add" id="add<?php echo $linha["id"];
                    echo $type ?>" onclick="addToCart(<?php echo $linha['id'] ?>, <?php echo $type ?>)">
                    Adicionar ao Carrinho
                    </button>
                </a>
                <a href="#row<?php echo $linha["id"] ?>" style="text-decoration: none">
                    <button class="remove" id="remove<?php echo $linha["id"];
                    echo $type ?>" onclick="removeFromCart(<?php echo $linha['id'] ?>, <?php echo $type ?>)">
                        Remover do Carrinho 
                    </button>
                </a>
            </div>
        </div>
    </section>
</body>
</html>

<script>
    let onCartType
    
    <?php if ($type == 1) { ?>
                                                  onCartType = "onCartSerie"
    <?php } else { ?>
                                                  onCartType = "onCartFilm"
    <?php } ?>

    const item = localStorage.getItem(<?php echo $id ?>)
    
    const btnAdd = document.querySelector("#add<?php echo $id ?><?php echo $type ?>");
    const btnRemove = document.querySelector("#remove<?php echo $id ?><?php echo $type ?>");

    if(item == onCartType) {
        btnAdd.classList.add("hide");
        btnRemove.classList.remove("hide");
    } else {
        btnAdd.classList.remove("hide");
        btnRemove.classList.add("hide");
    }
</script>

<?php mysqli_close($conexao) ?>
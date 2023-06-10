<?php
if (isset($_POST["nome"]) && isset($_POST["descricao"]) && isset($_POST["img"]) && isset($_POST["valor"]) && isset($_POST["tamanho"]) && isset($_GET["type"])) {
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $img = $_POST["img"];
    $valor = str_replace(",", ".", $_POST["valor"]);
    $tamanho = $_POST["tamanho"];
    $type = $_GET["type"];

    $conexao = mysqli_connect("localhost", "root", "", "popflix") or die("Falha de conexão");
    
    $tabela;
    $sql;
    if($type == 0) {
        $tabela = mysqli_query($conexao, "SELECT * FROM filmes WHERE (nome = '$nome')");
        $sql = "INSERT INTO filmes(nome, descricao, caminho_img, valor, tamanho) VALUES('$nome','$descricao', '$img', '$valor', '$tamanho')";
    } else if($type == 1) {
        $tabela = mysqli_query($conexao, "SELECT * FROM series WHERE (nome = '$nome')");
        $sql = "INSERT INTO series(nome, descricao, caminho_img, valor, tamanho) VALUES('$nome','$descricao', '$img', '$valor', '$tamanho')";
    }

    if (mysqli_num_rows($tabela) > 0) {
        echo $sql . " filme ou série já existe";
        mysqli_close($conexao);
    } else if (mysqli_query($conexao, $sql)) {
        mysqli_close($conexao);
        header("Location: http://localhost/pages/admin");
    } else {
        echo $sql . " " . mysqli_error($conexao);
        mysqli_close($conexao);
    }
}
?>
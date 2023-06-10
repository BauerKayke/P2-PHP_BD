<?php
if (isset($_GET["id"]) && isset($_POST["nome"]) && isset($_POST["descricao"]) && isset($_POST["img"]) && isset($_POST["valor"]) && isset($_POST["tamanho"]) && isset($_GET["type"])) {
    $id = $_GET["id"];
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $img = $_POST["img"];
    $valor = str_replace(",", ".", $_POST["valor"]);
    $tamanho = $_POST["tamanho"];
    $type = $_GET["type"];

    $conexao = mysqli_connect("localhost", "root", "", "popflix") or die("Falha de conexão");
    
    if($type == 0) {
        $sql = mysqli_query($conexao, "UPDATE filmes SET nome = '$nome', descricao = '$descricao', caminho_img = '$img', valor = '$valor', tamanho = '$tamanho' WHERE id='$id'");
        header("Location: http://localhost/pages/admin/selecionarFilme.php");
    } else if($type == 1) {
        $sql = mysqli_query($conexao, "UPDATE series SET nome = '$nome', descricao = '$descricao', caminho_img = '$img', valor = '$valor', tamanho = '$tamanho' WHERE id='$id'");
        header("Location: http://localhost/pages/admin/selecionarSerie.php");
    }
}
?>
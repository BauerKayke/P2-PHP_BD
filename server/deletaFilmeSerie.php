<?php
if (isset($_GET["id"]) && isset($_GET["type"])) {
    $id = $_GET["id"];
    $type = $_GET["type"];

    $conexao = mysqli_connect("localhost", "root", "", "popflix") or die("Falha de conexão");
    
    if($type == 0) {
        $sql = mysqli_query($conexao, "DELETE FROM filmes WHERE id='$id'");
        header("Location: http://localhost/pages/admin/selecionarFilme.php");
    } else if($type == 1) {
        $sql = mysqli_query($conexao, "DELETE FROM series WHERE id='$id'");
        header("Location: http://localhost/pages/admin/selecionarSerie.php");
    }
}
?>
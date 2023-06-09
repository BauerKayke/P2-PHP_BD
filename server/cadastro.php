<?php
if (isset($_POST["user"]) && isset($_POST["password"]) && isset($_POST["email"])) {
    $user = $_POST["user"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    $conexao = mysqli_connect("localhost", "root", "", "popflix") or die("Falha de conexão");
    $tabela = mysqli_query($conexao, "SELECT * FROM clientes WHERE (usuario = '$user')");
    $sql = "INSERT INTO clientes(usuario, nome, senha, email) VALUES('$user','$nome', '$password', '$email')";

    if (mysqli_num_rows($tabela) > 0) {
        echo $sql . " usuário já existe";
        mysqli_close($conexao);
    } else if (mysqli_query($conexao, $sql)) {
        mysqli_close($conexao);
        header("Location: /pages/login.php");
    } else {
        echo $sql . " " . mysqli_error($conexao);
    }
}
?>
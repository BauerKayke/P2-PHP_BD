<?php
    if(isset($_POST["user"]) && isset($_POST["password"])) {
        $user = $_POST["user"];
        $password = $_POST["password"];

        $conexao = mysqli_connect("localhost", "root", "", "popflix") or die("Falha de conexão");
        
        $tabela = mysqli_query($conexao, "SELECT * FROM usuarios");
    
        while($linhas = mysqli_fetch_array($tabela)) {
            if($user == $linhas["usuario"] && $password == $linhas["senha"]) {
                session_cache_expire(1);
                session_start();
                $_SESSION["login"] = true;
                $_SESSION["user"] = $user;
                mysqli_close($conexao);
                header('Location: http://localhost/');
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="../styles/style.css" />
    <link rel="stylesheet" href="../styles/login.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&family=PT+Sans&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet" />

    <title>Login</title>
</head>
<body>
    <div id="main">
        <form action="./login.php" method="POST">
            <div class="user">
                <label for="user">Usuário: </label>
                <input name="user" id="user" type="text">
            </div>

            <div class="password">
                <label for="">Senha: </label>
                <input name="password" id="password" type="password">
            </div>

            <div class="button">
                <button type="input">Acessar</button>
                <button type="button"><a href="./cadastrar.php">Cadastrar</a></button>
            </div>
        </form>
    </div>
</body>
</html>
<?php 
    session_start();

    if(!isset($_SESSION["login"]) || $_SESSION["login"] != true || $_SESSION["user"] != "admin") {
    header("Location: /");
    }
?>
<header>
    <div>
        <h1>PopFlix</h1>
    </div>
    <nav>
        <div>
            <ul>
                <li> <a class="navLink" href="./index.php">Cadastrar Filme</a></li>
                <li> <a class="navLink" href="./cadastrarSerie.php">Cadastrar série</a></li>
                <li> <a class="navLink" href="./selecionarFilme.php">Alterar filme</a></li>
                <li> <a class="navLink" href="./selecionarSerie.php">Alterar série</a></li>
            </ul>
        </div>
    </nav>
    <div class="user">
        <a href="/"><?php echo $_SESSION["user"] ?></a>
        <span><a href="/pages/sair.php">Sair</a></span>
    </div>
</header>
<?php session_start() ?>
<header>
    <div>
        <h1>PopFlix</h1>
    </div>
    <nav>
        <div>
            <ul>
                <li> <a class="navLink" href="../index.php">Filmes</a></li>
                <li> <a class="navLink" href="../pages/series.php">Series</a></li>
                <li> <a class="navLink" href="../pages/contact.php">Contato</a></li>
            </ul>
        </div>
    </nav>
    <div class="cart" id="cart" data-count="0">
        <a href="../pages/cart.php">
            <img src="../img/shopping-cart.png">
        </a>
    </div>
    <div class="user">
        <?php if($_SESSION["user"] == "admin"): ?>
            <a href="/pages/admin"><?php echo $_SESSION["user"] ?></a>
        <?php else: ?>
            <span><?php echo $_SESSION["user"] ?></span>
        <?php endif; ?>
        <span><a href="/pages/sair.php">Sair</a></span>
    </div>
</header>
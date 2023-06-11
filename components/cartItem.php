<div class='cart-item'>
    <div class='item-img'>
        <img class='item-cover' src='<?php echo $poster_path ?>'>
    </div>
    <div class='title'>
        <?php echo $title ?>
    </div>
    <div class='price'>
        <?php echo $price ?>
    </div>
    <!-- Adicionar Funçao de remover do carrinho -->
    <div id='remove' onclick="removeFromCart(<?php echo $id ?>, <?php echo $type ?>, true)">
        X
    </div>
</div>
<?php
$goods = myBasket();

if(!$count){
    echo '<p>No items. Go back to <a href="index.php?page=catalog">catalog</a></p>';
    exit;
} else{
    echo '<p>Go back to <a href="index.php?page=catalog">catalog</a></p>';
}
?>


<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <th></th>
        <th>Manufacturer</th>
        <th>Price</th>
        <th>Quantity</th>
        <th></th>
    </tr>
    <?php
    $i = 1;
    $sum = 0;
    foreach ($goods as $item){
    ?>

        <tr>
            <td><?= $i ?></td>
            <td><?= $item['title'] ?></td>
            <td><?= $item['price'] ?></td>
            <td><?= $item['quantity'] ?></td>
            <td><a href="delete_from_basket.php?id=<?= $item['id'] ?>">Remove</a></td>
        </tr>

    <?php
    $i++;
    $sum += $item['price'] * $item['quantity'];
    } ?>
</table>

<p>Total: <?= $sum ?> $</p>

<div align="center">
    <input type="button" value="Order now!"
           onClick="location.href='index.php?page=orderform'" />
</div>


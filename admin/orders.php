<?php
require "secure/session.inc.php";
require "../inc/lib.inc.php";
require "../inc/config.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Created orders</title>
    <meta charset="utf-8">
</head>
<body>
<h1>Orders:</h1>
<?php
$orders = getOrders();
//print_r($orders);
if(!$orders){
    echo "No orders!";
    exit;
}
foreach ($orders as $order){
    $dt = date("d-m-Y H:i", $order['date']);
?>
<hr>
<h2>Order ID: <?= $order['orderid'] ?></h2>
<p><b>Customer</b>: <?= $order['name'] ?></p>
<p><b>Email</b>: <?= $order['email'] ?></p>
<p><b>Phone</b>: <?= $order['phone'] ?></p>
<p><b>Address</b>: <?= $order['address'] ?></p>
<p><b>Order date</b>: <?= $dt ?></p>

<h3>Ordered products:</h3>
<table border="1" cellpadding="5" cellspacing="0" width="90%">
    <tr>
        <th>N</th>
        <th>Model</th>
        <th>Price</th>
        <th>Quantity</th>
    </tr>
    <?php
    $i = 1;
    $sum = 0;
    foreach ($order['goods'] as $item){
        ?>

        <tr>
            <td><?= $i ?></td>
            <td><?= $item['title'] ?></td>
            <td><?= $item['price'] ?></td>
            <td><?= $item['quantity'] ?></td>
        </tr>

        <?php
        $i++;
        $sum += $item['price'] * $item['quantity'];
    } ?>

</table>
<p>Total orders: <?=$sum ?></p>
<?php } //end of big foreach ?>
</body>
</html>
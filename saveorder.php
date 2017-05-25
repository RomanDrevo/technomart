<?php
require "inc/lib.inc.php";
require "inc/config.inc.php";

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$dt = time();
$order_id = $basket['orderid'];

$order = "$name|$email|$phone|$address|$dt|$order_id\n";

file_put_contents("admin/". ORDERS_LOG, $order, FILE_APPEND);

saveOrder($dt);
?>


<p>Your order was confirmed!</p>
<p><a href="index.php?page=catalog">Back to catalog.</a></p>


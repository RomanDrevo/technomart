<?php
require "inc/lib.inc.php";
require "inc/config.inc.php";

$id = $_GET['id'];
//echo $id;
if($id){
    removeFromBasket($id);
}

header("Location: index.php?page=basket");
exit;
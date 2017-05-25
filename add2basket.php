<?php
require "inc/lib.inc.php";
require "inc/config.inc.php";

$id = $_GET['id'];
//echo $id;
if($id){
    add2Basket($id);
}

header("Location: index.php?page=catalog");
exit;
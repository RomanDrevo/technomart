<?php
include 'inc/lib.inc.php';
include "inc/config.inc.php";
// just so we know it is broken
error_reporting(E_ALL);
// some basic sanity checks
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    //connect to the db
    $link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME) or die('No Connection');

    // select our database
    mysqli_select_db(DB_NAME) or die(mysqli_error());

    // get the image from the db
    $sql = "SELECT image FROM catalog WHERE id=" .$_GET['id'] . ";";

    // the result of the query
    $result = mysqli_query("$sql") or die("Invalid query: " . mysqli_error());
    // set the header for the image
    header("Content-type: image/jpeg");
    echo mysqli_result($result, 0);

    // close the db link
    mysqli_close($link);
}
else {
    echo 'Please use a real id number';
}
?>
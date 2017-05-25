<?php
require_once "secure/session.inc.php";
require_once "secure/secure.inc.php";

if(isset($_GET['logout'])){   
    logOut(); 
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Admin page</title>
    <meta charset="utf-8">
</head>
<body>
<h1>Store management</h1>
<h3>You can:</h3>
<ul>
    <li><a href='add2cat.php'>Add to catalog</a></li>
    <li><a href='orders.php'>Check orders</a></li>
    <li><a href='secure/create_user.php'>Add user</a></li>
    <li><a href='index.php?logout'>End session</a></li>
</ul>
</body>
</html>
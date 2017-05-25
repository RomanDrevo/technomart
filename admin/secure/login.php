<?php
$title = 'Authorisation';
$login  = '';

session_start();
header("HTTP/1.0 401 Unauthorized");
require_once "secure.inc.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $login = trim(strip_tags($_POST["login"]));
    $pw = trim(strip_tags($_POST["pw"]));
    $ref = trim(strip_tags($_GET["ref"]));
    if(!$ref)
        $ref = '/technomart/admin/';
    if($login and $pw){
        if($result = userExists($login)){
            list($_, $hash) = explode(':', $result);
            if(checkHash($pw, $hash)){
                $_SESSION['admin'] = true;
                header("Location: $ref");
                exit;
            }
            else{
                $title = 'Wrong login or password!';
            }
        }else{
            $title = 'Wrong login or password!';
        }
    }else{
        $title = 'Fill out all fields!';
    }
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Authorisation</title>
    <meta charset="utf-8">
</head>
<body>
<h1><?= $title?></h1>
<form action="<?= $_SERVER['REQUEST_URI']?>" method="post">
    <div>
        <label for="txtUser">Login</label>
        <input id="txtUser" type="text" name="login" value="<?= $login?>" />
    </div>
    <div>
        <label for="txtString">Password</label>
        <input id="txtString" type="password" name="pw" />
    </div>
    <div>
        <button type="submit">Enter</button>
    </div>
</form>
</body>
</html>
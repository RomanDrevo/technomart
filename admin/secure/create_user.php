<?php
//error_reporting(0);
require_once "session.inc.php";
require_once "secure.inc.php";
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Create user</title>
    <meta charset="utf-8">
</head>

<body>
<h1>Create user</h1>
<?php
$login = 'root';
$password = '1234';
$result = '';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $login = $_POST['login'] ?: $login;
    if(!userExists($login)){
        $password = $_POST['password'] ?: $password;
        $hash = getHash($password);
        if(saveUser($login, $hash))
            $result = 'Hash '. $hash. ' was successfully added to file.';
        else
            $result = 'Error when created hash '. $hash;
    }else{
        $result = "Username $login already exist. Choose another login";
    }
}
?>
<h3><?= $result?></h3>
<form action="<?= $_SERVER['PHP_SELF']?>" method="post">
    <div>
        <label for="txtUser">Login</label>
        <input id="txtUser" type="text" name="login" value="<?= $login?>" style="width:40em"/>
    </div>
    <div>
        <label for="txtString">Password</label>
        <input id="txtString" type="text" name="password" value="<?= $password?>" style="width:40em"/>
    </div>
    <div>
        <button type="submit">Create</button>
    </div>
</form>
</body>
</html>
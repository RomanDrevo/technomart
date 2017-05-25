<?php
error_reporting(-1);
//error_reporting( error_reporting() & ~E_NOTICE );
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
//error_reporting(E_ALL & ~E_NOTICE);
//header('Content-type: text/html; charset=Windows-1251');
include 'inc/lib.inc.php';
include 'inc/config.inc.php';

if(!isset($_GET['page']))
    $_GET['page'] = 'index'
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>index</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="styles/normalize.css">
    <link rel="stylesheet" href="styles/style.css">
    <script type="text/javascript" src="scripts/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="scripts/filter.js"></script>
    <script type="text/javascript" src="scripts/slider_toggle.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>



<body>

<div class="header">


    <div class="header-menu-top">

        <div class="container clearfix">

            <div class="header-menu-top-left"><a href="#">Technomart</a>
                <a href="#"><i class="glyphicon glyphicon-search"></i>Search</a>
            </div>

            <div class="header-menu-top-right"><a href="under_construction.html"><i class="glyphicon glyphicon-bookmark"></i>Bookmarks</a>
                <a href="basket.php"><i class="icon-basket"></i>Shopping cart <?= $count?></a>
                <a href="orderform.php" class="active">Order</a>
            </div>

        </div>

    </div>

    <div class="container">

        <div class="clearfix">
            <p class="header-intro">Online-store
                <br>of constructional materials
                <br>and repair tools </p>
            <div class="header-contacts">
                <div class="tel"><i class="glyphicon glyphicon-phone-alt"></i><span>+972 3-555-05-55</span>
                </div>
                <p>Tel-Aviv-Yafo, Dizengoff St.1, second floor</p>
            </div>
            <div class="login">
                <div class="login-form"><i class=" icon-login"></i>Log in</div>
                <div class="login-form">Register</div>
            </div>
        </div>

        <div class="header-bottom-menu">
            <ul>
                <li><a href="index.php">Home</a>
                </li>
                <li><a href="index.php?page=catalog">Catalog</a>
                </li>
                <li><a href="index.php?page=news">News</a>
                </li>
                <li><a href="">Specials</a>
                </li>
                <li><a href="">Shipping</a>
                </li>
                <li><a href="index.php?page=contacts">Contacts</a>
                </li>
            </ul>
            <?php
                include $_GET['page'] . '.php';
            ?>
        </div>
    </div>
</div>

<?php
abstract class DB{
    abstract function connect();
}


const DB_HOST = '127.0.0.1';
const DB_LOGIN = 'homestead';
const DB_PASSWORD = 'secret';
const DB_NAME = 'technomart';
const ORDERS_LOG = 'orders.log';

class DbConnect extends DB{
    function connect(){
        $link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME) or die('No Connection');
        return $link;
    }
}

$connection = new DbConnect;
$link = $connection->connect();


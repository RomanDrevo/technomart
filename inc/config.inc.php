<?php
const DB_HOST = 'localhost';
const DB_LOGIN = 'orange';
const DB_PASSWORD = 'orange2312!';
const DB_NAME = 'orange_technomart';
const ORDERS_LOG = 'orders.log';

$basket = array();
$count = 0;

$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME) or die('No Connection');

basketInit();


$start=0;
$limit=6;

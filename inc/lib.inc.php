<?php

function fetchAllAssoc($result)
{
	for ($res = []; $row = $result->fetch_assoc(); $res[] = $row);
	return $res;
}

function addItemToCatalog($manufacturer, $model, $price){
    $link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME) or die('No Connection');

    $sql = 'INSERT INTO catalog(manufacturer, model, price)
              VALUES ($manufacturer, $model, $price)';

    if (!$stmt = mysqli_prepare($link, $sql))
        return false;
    mysqli_stmt_bind_param($stmt, "ssii", $manufacturer, $model, $price);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;

};

function selectAllItems(){
    global $link, $start, $limit;
    $sql = "SELECT * FROM catalog";
    if(!$result = mysqli_query($link, $sql)){
        return false;
    }
    $items = fetchAllAssoc($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    $rows=mysqli_num_rows(mysqli_query($link, "SELECT * FROM catalog"));
    $total=ceil($rows/$limit);
//    echo $total;
    return $total;
};

function selectfirstTenItems(){
    global $link, $start, $limit;
    $sql = "SELECT * FROM catalog LIMIT $start, $limit";
    if(!$result = mysqli_query($link, $sql)){
        return false;
    }
    $items = fetchAllAssoc($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $items;
}

function selectSingleItem($id){
    $i = $id;
    global $link;
    $sql = "SELECT * FROM catalog WHERE id = $i";
    $result = mysqli_query($link, $sql);
    if(!$result = mysqli_query($link, $sql)){
        return false;
    }
    $item = mysqli_fetch_array($result);
    mysqli_free_result($result);
    return $item;

};

function saveBasket(){
    global $basket;
    $basket = base64_encode(serialize($basket));
    setcookie('basket', $basket, 0x7FFFFFFF);
}

function basketInit(){
    global $basket, $count;
    if(!isset($_COOKIE['basket'])){
        $basket = ['orderid' => rand(100,999)];
        saveBasket();
    }
    else{
        $basket = unserialize(base64_decode($_COOKIE['basket']));
        $count = count($basket) - 1;
    }
}

function add2Basket($id){
    global $basket;
    $basket[$id] = 1;
    saveBasket();
}

function removeFromBasket($id){
    global $basket;
    unset($basket[$id]);
    saveBasket();
}

function result2Array($data){
    global $basket;
    $arr = [];
    while ($row = mysqli_fetch_assoc($data)){
        $row['quantity'] = $basket[$row['id']];
        $arr[] = $row;
    }
    return $arr;
}

function myBasket(){
    global $link, $basket;
    $goods = array_keys($basket);
    array_shift($goods);
    if(!$goods)
        return false;
    $ids = implode(",", $goods);
    $sql = "SELECT id, title, price FROM catalog WHERE id IN ($ids)";
    if(!$result = mysqli_query($link, $sql))
        return false;
    $items = result2Array($result);
    mysqli_free_result($result);
    return $items;
}

function saveOrder($dt){
    global $link, $basket;
    $goods = myBasket();
    $stmt = mysqli_stmt_init($link);

    $sql = "INSERT INTO orders (title, price, quantity, orderid, datetime) VALUES (?, ?, ?, ?, ?)";
    if (!mysqli_stmt_prepare($stmt, $sql))
        return false;
    foreach($goods as $item){
        mysqli_stmt_bind_param($stmt, "siiii",$item['title'],$item['price'],$item['quantity'],$basket['orderid'],$dt);
        mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
    setcookie("basket","", 1);
    return true;

}

function getOrders(){
    global $link;
    if(!is_file(ORDERS_LOG))
        return false;
    /* Получаем в виде массива персональные данные пользователей из файла */
    $orders = file(ORDERS_LOG);
    /* Массив, который будет возвращен функцией */
    $allorders = [];
    foreach ($orders as $order) {
        list($name, $email, $phone, $address, $date, $orderid) = explode("|",   trim($order));
        /* Промежуточный массив для хранения информации о конкретном заказе */
        $orderinfo = [];
        /* Сохранение информацию о конкретном пользователе */
        $orderinfo["name"] = $name;
        $orderinfo["email"] = $email;
        $orderinfo["phone"] = $phone;
        $orderinfo["address"] = $address;
        $orderinfo["orderid"] = $orderid;
        $orderinfo["date"] = $date;
        /* SQL-запрос на выборку из таблицы orders всех товаров для конкретного покупателя */
        $sql = "SELECT title, price, quantity FROM orders WHERE orderid = '$orderid'";
//        echo $sql;
        /* Получение результата выборки */
        if(!$result = mysqli_query($link, $sql))
            return false;
        $items = fetchAllAssoc($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        /* Сохранение результата в промежуточном массиве */
        $orderinfo["goods"] = $items;
        /* Добавление промежуточного массива в возвращаемый массив */
        $allorders[] = $orderinfo; }
    return $allorders;

}

function mysql2Json(){
    global $link;
    $sql = "select * from catalog";
    $result = mysqli_query($link, $sql);
    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }
    $json = json_encode($emparray);
    return $json;
}


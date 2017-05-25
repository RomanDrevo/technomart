<?php
$id = strtolower(strip_tags(trim($_GET['id'])));
switch($id){
    case 'contacts': include '../contacts.php'; break;
    case 'catalog': include '../catalog.php'; break;
    case 'news': include '../news.php'; break;
//    case 'log': include 'view-log.inc.php'; break;
//    case 'gbook': include 'gbook.inc.php'; break;
//    default: include '../index.php';
}
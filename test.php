<?php
include 'inc/lib.inc.php';
include 'inc/config.inc.php';

//$x = mysql2Json();
//echo $x;

$referenceTable = array();
$referenceTable['val1'] = array(1, 2);
$referenceTable['val2'] = 3;
$referenceTable['val3'] = array(4, 5);

$testArray = array();

$testArray = array_merge($testArray, $referenceTable['val1']);
var_dump($testArray);

$testArray = array_merge($testArray, $referenceTable['val3']);
var_dump($testArray);

$x = true and false;
var_dump($x); 
?>

<!---->
<?php
//$products = selectAllItems();
//foreach ($products as $item) : ?>
<!---->
<!--   <table align="center">-->
<!--        <tr>-->
<!--            <td align="top">-->
<!--                <div><a href="#"><img src="userfiles/--><?//= $item['image'] ?><!--"></a></div>-->
<!--                <div><a href="#">--><?//= $item['title'] ?><!--</a></div>-->
<!--                <div><a href="#">--><?//= $item['price'] ?><!--</a></div>-->
<!--            </td>-->
<!--        </tr>-->
<!--   </table>-->
<!---->
<?php //endforeach; ?>
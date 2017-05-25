<?php
error_reporting(-1);
include 'inc/lib.inc.php';
include 'inc/config.inc.php';
?>

<html>
    <head>

    </head>
<body>

<div style="border: 1px solid red">
<?php
$products = selectAllItems();
foreach ($products as $item) : ?>
    <div class="col-sm-4 catalog-item">
        <div class="flag"></div>
        <!--                            <div class="actions">-->
        <!--                                <a href="under_construction.html"><i class="icon-basket"></i>buy now</a>-->
        <!--                                <a href="under_construction.html">bookmark</a>-->
        <!--                            </div>-->
        <a href="index.php?page=single-item&id=<?php echo $item['id']?>"><img src="userfiles/<?php echo $item['image']?>"></a>
        <div class="text">
            <div><span class="name"><?= $item['title'] ?></span>
                <span class="power-type">Battery</span>
            </div>
            <div>22 500 $</div>
            <div class="price"><?= $item['price'] ?> $</div>
        </div>
    </div>
<?php endforeach; ?>
</div>



<div style="border: 1px solid blue">
    <?php
    $id = 14;
    $product = selectSingleItem($id);
    ?>
        <div class="col-sm-4 catalog-item">
            <div class="flag"></div>

            <img src="userfiles/<?php echo $product['image']?>">
            <div class="text">
                <div><span class="name"><?= $product['title'] ?></span>
                    <span class="power-type">Battery</span>
                </div>
                <div>22 500 $</div>
                <div class="price"><?= $product ['price'] ?> $</div>
            </div>
        </div>

</div>
</body>
</html>

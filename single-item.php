

<?php
$id = $_GET['id'];

$product = selectSingleItem($id);
?>



<div class="main-content">
    <div class="container" style="border: 1px dashed red">
        <div class="bread-crumps-menu">
            <ul>
                <li><a href="index_technomart.html"><i class="icon-home"></i> <i class="icon-right"> </i></a>
                </li>
                <li><a href="under_construction.html">Catalog<i class="icon-right"> </i></a>
                </li>
                <li><a href="under_construction.html">Tools<i class="icon-right"> </i></a>
                </li>
                <li><a href="under_construction.html">Hammer Drills</a>
                </li>

            </ul>
        </div>

<!--        <div class="perforator-heading">-->
<!--            <h1>Hammer Drills</h1>-->
<!--        </div>-->








            <div class="col-sm-4 catalog-item">
                <div class="flag"></div>
                <!--        <div class="actions">-->
                <!--            <a href="under_construction.html"><i class="icon-basket"></i>buy now</a>-->
                <!--            <a href="under_construction.html">bookmark</a>-->
                <!--        </div>-->
                <img src="userfiles/<?php echo $product['image']?>">
                <div class="text">
                    <div><span class="name"><?= $product['title'] ?></span>
                        <span class="power-type">Battery</span>
                    </div>
                    <div>22 500 $</div>
                    <div class="price"><?= $product['price'] ?> $</div>
                </div>
            </div>
            <div class="col-sm-8">
                <p><b><?= $product['title'] ?></b> <?= $product['description'] ?></p>
                <a href="add2basket.php?id=<?php echo $product['id']?>">Add to cart</a>
            </div>

    </div>
</div>
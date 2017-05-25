<?php
global $start, $limit;

$total = selectAllItems();

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $start=($id-1)*$limit;
    echo $start;
}
else{
    $id=1;
}
?>


    <div class="main-content">
        <div class="container">
            <div class="bread-crumps-menu">
                <ul>
                    <li><a href="#"><i class="icon-home"></i> <i class="icon-right"> </i></a>
                    </li>
                    <li><a href="#">Catalog<i class="icon-right"> </i></a>
                    </li>
                    <li><a href="#">Tools<i class="icon-right"> </i></a>
                    </li>
                    <li><a href="#">Hammer Drills</a>
                    </li>

                </ul>
            </div>

            <div class="perforator-heading">
                <h1>Hammer Drills</h1>
            </div>


            <div class="col-sm-3 price-filter">
                <div>Filter</div>
                <span>Price:</span>

                <form id="priceFilterForm" action="#" method="post">


                    <b>$ 0</b> <input id="ex2" type="text" class="span2" value="" data-slider-min="0" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,450]"/> <b>$ 1000</b>

<!--                    <div class="price-controls">-->
<!--                        <input type="text" class="price-min" value="0">-->
<!--                        <input type="text" class="price-max" value="30000">-->
<!--                    </div>-->
                    <div class="manufacturers">
                        <span>manufacturers:</span>
                        <br>
                        <ul id="manufacture">
                            <li>
                                <input type="checkbox" id="che1" name="che1" value="bosch">
                                <label for="che1">bosch</label>
                            </li>
                            <li>
                                <input type="checkbox" id="che2" name="che2" value="interscol">
                                <label for="che2">interscol</label>
                            </li>
                            <li>
                                <input type="checkbox" id="che3" name="che3" value="makita">
                                <label for="che3">makita</label>
                            </li>
                            <li>
                                <input type="checkbox" id="che4" name="che4" value="dewalt">
                                <label for="che4">dewalt</label>
                            </li>
                            <li>
                                <input type="checkbox" id="che5" name="che5" value="hitachi">
                                <label for="che5">hitachi</label>
                            </li>

                        </ul>
                    </div>

                    <div class="power">
                        <span>power type:</span>
                        <ul>
                            <li>
                                <input type="radio" id="radio1" name="toggle" value="battery" checked>
                                <label for="radio1">battery</label>
                            </li>
                            <li>
                                <input type="radio" id="radio2" name="toggle" value="adapter">
                                <label for="radio2">adapter</label>
                            </li>
                        </ul>
                    </div>
                    <input type="submit" value="SHOW">
                </form>

            </div>

            <div class="col-sm-9 catalog">

<!--                <div class="catalog-heading">-->
<!--                    <div>Sort by:</div>-->
<!--                    <div class="active">Price</div>-->
<!--                    <div>Manufacturer</div>-->
<!--                    <div>Power Type</div>-->
<!--                    <i class="icon-up-dir"></i>-->
<!--                    <i class="icon-down-dir"></i>-->
<!---->
<!--                </div>-->

                <div class="col-sm-12 catalog-items">
                        <?php
                        $products = selectfirstTenItems();
                        foreach ($products as $item) : ?>
                        <div class="col-sm-4 catalog-item">
                            <div class="flag"></div>
<!--                            <div class="actions">-->
<!--                                <a href="add2basket.php?id=--><?php //echo $item['id']?><!--"><i class="icon-basket"></i>add to cart</a>-->
<!--                                <a href="#">bookmark</a>-->
<!--                            </div>-->
                            <a href="index.php?page=single-item&id=<?php echo $item['id']?>"><img src="userfiles/<?php echo $item['image']?>"></a>
                            <div class="text">
                                <div><span class="name"><?= $item['title'] ?></span>
                                    <span class="power-type">Battery</span>
                                </div>
                                <div><?= $item['old_price'] ?> $</div>
                                <div class="price"><?= $item['price'] ?> $</div>
                            </div>
                        </div>
                        <?php endforeach; ?>

                </div>

                <div class="page-numbers">
                    <!--                    <a href="#" class="active">1</a>-->
                    <!--                    <a href="#">2</a>-->
                    <!--                    <a href="#">3</a>-->
                    <!--                    <a href="#">Next</a>-->
                    <?php
                    if($id>1)
                    {
                        //Go to previous page to show previous 10 items. If its in page 1 then it is inactive
                        echo "<a href='index.php?page=catalog&id=".($id-1)."' class='button'>PREVIOUS</a>";
                    }
                    ?>

                    <?php
                    //show all the page link with page number. When click on these numbers go to particular page.
                    for($i=1;$i<=$total;$i++)
                    {
                        if($i==$id) { echo "<a class='current'>".$i."</a>"; }

                        else { echo "<a href='index.php?page=catalog&id=".$i."'>".$i."</a>"; }
                    }
                    ?>

                    <?php
                    if($id!=$total)
                    {
                        ////Go to previous page to show next 10 items.
                        echo "<a href='index.php?page=catalog&id=".($id+1)."' class='button'>NEXT</a>";
                    }
                    ?>

                </div>

            </div>
        </div>
    </div>




    <div class="perforator">
        <div class="container">
            <h2>ABOUT HAMMER DRILLS</h2>
            <p>Curabitur molestie lorem eu luctus mollis. Integer eget euismod lacus. Vivamus vitae risus vitae nunc
                accumsan imperdiet. Pellentesque ante lacus, rutrum sed scelerisque ac, imperdiet ut nibh. Donec id
                neque et velit elementum accumsan. Aliquam erat volutpat. Nam tempor justo vel nulla vestibulum commodo.
                Sed ac mollis leo, ut placerat risus. Proin semper tristique elit, quis mattis est viverra a.</p>
        </div>
    </div>



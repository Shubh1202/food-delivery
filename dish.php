<?php 
include("./inc/head.php"); 
$status = 1;
$attrArray = cartArray();
?>
    <title>Khatejao.com</title>
</head>
<body>
<?php include("./inc/header.php"); ?>
        <div class="breadcrumb-area gray-bg">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Dishes </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="shop-page-area pt-100 pb-100">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-9">
                        <div class="shop-topbar-wrapper">
                            <div class="product-sorting-wrapper">
                                <div class="product-show shorting-style ">
                                    <label>Sort by:</label>
                                    <select id="dishtype">
                                        <option value="">All Dish</option>
                                    <?php 
                                        $array = array("all dish","veg","non-veg");
                                        foreach ($array as  $value) {
                                            if($value == $_GET['dishtype'])
                                                echo "<option selected value='".$value."'>".ucwords($value)."</option>";
                                            else
                                                echo "<option value='".$value."'>".ucwords($value)."</option>";
                                    } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="grid-list-product-wrapper">
                            <div class="product-grid product-view pb-20">
                                <div class="row">
                                <?php
                                if (!isset($_GET['dish']))
                                    $dish = get_dish('',$status,'',$_GET['dishtype']);
                                else if(isset($_GET['dish']))
                                    $dish = get_dish('',$status,$_GET['dish'],$_GET['dishtype']);

                                    foreach ($dish as $value) {
                                ?>
                                    <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                        <div class="product-wrapper">
                                            <div class="product-img">
                                                <a href="product-details.html">
                                                    <img src="<?php echo FRONT_DISH_IMAGE.$value['dish_img'];?>" alt="<?php echo $value['dish_name'];?>">
                                                </a>
                                                <div class="product-action">
                                                    <div class="pro-action-left" >
                                                        <a title="Add Tto Cart" href="javascript:void(0)" class="add-to-cart" onclick="addCart('<?php echo $value['dxid'];?>')">
                                                            <i class="ion-android-cart"></i> Add Tto Cart
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h4>
                                                    <i class="fa fa-dot-circle-o <?php echo $value['dish_type'];?>" aria-hidden="true"></i>
                                                    <a href="javascript:void(0)"><?php echo $value['dish_name'];?> </a>
                                                    <input type="number" name="orderQty" min="0" class="qty Qty<?php echo $value['dxid'];?>" value="0">
                                                </h4>
                                                <div class="product-price-wrapper">
                                                    <?php 
                                                        $dish_detail = dish_detail($value['dxid'],$status);
                                                        foreach ($dish_detail as $result) {
                                                    ?>
                                                        <span>
                                                            <input type="radio" name="detail<?php echo $value['dxid'];?>" value="<?php echo $result['deid'];?>" >
                                                            <i class="fa fa-inr"></i> 
                                                            <?php echo $result['price'];?>
                                                            <span class="text-muted"><?php echo "(".$result['qty'].")";?></span>
                                                        </span>
                                                        <?php if(array_key_exists($result['deid'], $attrArray)) { ?>
                                                        <span class="text-danger cart-info<?php echo $result['deid'];?>"><?php echo "(Added - ".cartArray($result['deid']).") "?></span>
                                                        <?php }else { ?>
                                                        <span class="text-danger cart-info<?php echo $result['deid'];?>"></span>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg">
                            <div class="shop-widget">
                                <h4 class="shop-sidebar-title">Shop By Categories</h4>
                                <div class="shop-catigory">
                                    <ul id="faq">
                                        <li><a href="dish.php">All Clear</a></li>
                                    <?php 
                                        $category = get_category('',$status);
                                        foreach ($category as $value) {
                                    ?>
                                        <li> <a href="?dish=<?php echo $value['catxid'];?>"><?php echo $value['category'];?></a> </li>
                                    <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 
    include("./inc/footer.php");
    include("./inc/js-links.php"); 
?>
</body>
</html>
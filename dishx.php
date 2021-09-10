<?php 
include("./inc/head.php"); 
if (isset($_REQUEST['dishtype'])) {
   $dishtype = $_REQUEST['dishtype'];
}
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
                        <li class="active">Dish</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="shop-page-area pt-100 pb-100">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-9">
                        <div class="grid-list-product-wrapper">
                            <div class="product-grid product-view pb-20">
                                <div class="row mb-30 text-right">
                                    <div class="col-md-12">
                                    <?php 
                                    $typeArray = array("veg","non-veg","all dish");
                                    foreach ($typeArray as  $value) {
                                        if($dishtype == $value){
                                            $checked = "checked";
                                        echo "<span class='price'><input type='radio' name='dishtype' class='dishtype' $checked value='".$value."'>". ucwords($value)."</span>";
                                        }else{
                                        echo "<span class='price'><input type='radio' name='dishtype' class='dishtype'  value='".$value."'>". ucwords($value)."</span>";
                                    }
                                    }
                                    ?>
                                    </div>
                                </div>
                                <div class="row">
                                <?php
                                if(!isset($_REQUEST['food'])){
                                    $dish = get_dish('',1,'',$dishtype);
                                }else if(isset($_REQUEST['food'])){
                                    $dish = get_dish('',1,$_REQUEST['food'],$dishtype);
                                }
                                $count = count($dish);
                                if($count>0){
                                    foreach ($dish as $value) {
                                    $dish_detail = dish_detail($value['dxid'],1);
                                ?>
                                    <div class="product-width pro-list-none col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                        <div class="product-wrapper">
                                            <div class="product-img">
                                                <a href="javascript:void(0);">
                                                    <img src="<?php echo FRONT_DISH_IMAGE.$value['dish_img'];?>" alt="">
                                                </a>
                                                <div class="product-action">
                                                    <div class="pro-action-left">
                                                        <a title="Add Tto Cart" href="javascript:void(0)" onclick="addCart('<?php echo $value['dxid'];?>');"><i class="ion-android-cart"></i> Add Tto Cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="pro-action-left">
                                                    <a href="javascript:void(0);"><?php echo $value['dish_name'];?> (<?php echo $value['dish_type'];?>)</a> 
                                                    <input type="number" name="qty" min="1" max="20" value="1" id="qty<?php echo $value['dxid'];?>">
                                                </div>
                                                <div class="product-price-wrapper">
                                                <?php foreach ($dish_detail as $result) { ?>
                                                    <span class="price">
                                                        <input type="radio" name="price" value="<?php echo $result['price'];?>" onclick="setInputData('<?php echo $result['deid'];?>')">
                                                        <span class="text-muted">
                                                            Rs <?php echo $result['price'];?> (<?php echo $result['qty'];?>)
                                                            <?php
                                                            if(array_key_exists($result['deid'], $cartArray))
                                                                echo "<span class='text-danger' id='added_dish_update".$result['deid']."'>(Added -".cart_detail($result['deid']).")</span>";
                                                            ?>
                                                        </span>
                                                    </span>
                                                <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } } else if($count==0){ ?>
                                        <div class="product-wrapper">
                                            <h4>Dish not available</h4>
                                        </div>
                                <?php } ?>
                                    <input type="hidden" name="dexid" id="dexid">
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
                                        <li ><a href="dish.php">All Clear</a></li>
                                    </ul>
                                </div>
                                <div class="shop-catigory">
                                    <ul id="faq">
                                    <?php 
                                        $category = get_category('', 1);
                                        foreach ($category as $value) {
                                    ?>
                                        <li >
                                            <a  href="dish.php?food=<?php echo $value['catxid'];?>" <?php if($_REQUEST['food']==$value['catxid']) echo 'style="color:red;"';?>><?php echo $value['category'];?></a>
                                        </li>
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

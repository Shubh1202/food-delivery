<?php 
include("./inc/head.php"); 
$status = 1;
$attrArray = cartArray();
// print_r($attrArray);

if(isset($_POST['update-cart'])){
    foreach ($_POST['qty'] as $key => $value) {
        $qty = $value;
        $id = $key;
        if(isset($_SESSION['uxid'])){
            $sql = mysqli_query($con,"UPDATE `cart` SET `cartqty`='$qty' WHERE `dexid`='$id' AND `uxid`='".$_SESSION['uxid']."' ");
        }else{
            $_SESSION['cart'][$key] = $qty;
        }
    }
    header("location:cart-page.php");
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
                        <li class="active">Cart </li>
                    </ul>
                </div>
            </div>
        </div>
         <!-- shopping-cart-area start -->
        <div class="cart-main-area pt-95 pb-100">
            <div class="container">
                <?php if(count($attrArray)>0){ ?>
                <div class="cart-table">
                <h3 class="page-title">Your cart items</h3>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <form action="" method="post">
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Until Price</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($attrArray as $key => $value) { ?>
                                        <tr class="dishrow<?php echo $key;?>">
                                            <td class="product-thumbnail">
                                                <a href="javascript:;"><img src="<?php echo FRONT_DISH_IMAGE.$value['dish_img'];?>" alt="" width="80"></a>
                                            </td>
                                            <td class="product-name"><a href="javascript:;"><?php echo $value['dish_name'];?> </a></td>
                                            <td class="product-price-cart"><span class="amount"><i class="fa fa-inr"></i> <?php echo $value['price'];?></span></td>
                                            <td class="product-quantity">
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" type="text" name="qty[<?php echo $key;?>]" value="<?php echo $value['qty'];?>">
                                                </div>
                                            </td>
                                            <td class="product-subtotal"><i class="fa fa-inr"></i> <?php echo $value['qty']*$value['price'];?></td>
                                            <td class="product-remove">
                                                <a href="javascript:;" onclick="removeItem('<?php echo $key;?>','<?php echo $value['qty']*$value['price'];?>')"><i class="fa fa-times"></i></a>
                                           </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cart-shiping-update-wrapper">
                                        <div class="cart-shiping-update">
                                            <a href="dish.php">Continue Shopping</a>
                                        </div>
                                        <div class="cart-clear">
                                            <button type="submit" name="update-cart">Update Cart</button>
                                            <a href="checkout.php">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php }else {?>
                <span class="empty-message text-center"><h2>Your cart is empty</h2></span>
            <?php } ?>
            </div>
        </div>
<?php 
    include("./inc/footer.php");
    include("./inc/js-links.php"); 
?>
</body>
</html>
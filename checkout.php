<?php 
include("./inc/head.php"); 
$status = 1;
$attrArray = cartArray();
if(count($attrArray)==0){
    header("location:dish.php");
}
if(isset($_SESSION['uxid'])){
    $show2 = "show";
    $payment1 = "";
    $payment2 = "payment-2";
    $user = get_users($_SESSION['uxid']);
}else if(!isset($_SESSION['uxid'])){
    $show1 = "show";
    $payment1 = "payment-1";
    $payment2 = "";
}

?>
<style>
.payable, .coupon{display: none;}
</style>
    <title>Khatejao.com</title>
</head>
<body>
<?php include("./inc/header.php"); ?>
        <div class="breadcrumb-area gray-bg">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li class="active"> Checkout </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- checkout-area start -->
        <div class="checkout-area pb-80 pt-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="checkout-wrapper">
                            <div id="faq" class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><span>1.</span> 
                                            <a data-toggle="collapse" data-parent="#faq" href="#<?php echo $payment1;?>">Login & Register</a>
                                        </h5>
                                    </div>
                                    <div id="<?php echo $payment1;?>" class="panel-collapse collapse <?php echo $show1;?>">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <form method="post" action="" id="frmLogin">
                                                        <div class="checkout-login">
                                                            <div class="title-wrap">
                                                                <h4 class="cart-bottom-title section-bg-white">LOGIN</h4>
                                                            </div>
                                                            <span>Please log in below:</span>
                                                            <div class="login-form">
                                                                <label>Email Address * </label>
                                                                <input type="email" name="user_email" required>
                                                            </div>
                                                            <div class="login-form password">
                                                                <label>Password *</label>
                                                                <input type="password" name="user_password" required>
                                                            </div>
                                                            <div class="login-forget">
                                                                <a href="javascript:;" id="forget">Forgot your password?</a>
                                                                <p>* Required Fields</p>
                                                            </div>
                                                            <div class="billing-btn">
                                                                <button type="submit" id="btn-login">Login</button>
                                                                <input type="hidden" id="checkout" name="checkout" value="checkout">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><span>2.</span> <a data-toggle="collapse" data-parent="#faq" href="#<?php echo $payment2;?>">Delivery Address</a></h5>
                                    </div>
                                    <div id="<?php echo $payment2;?>" class="panel-collapse collapse <?php echo $show2;?>">
                                        <form id="orderPlace" method="post" action="">
                                            <div class="panel-body">
                                                <div class="billing-information-wrapper">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="billing-info">
                                                                <button type="button" class="btn btn-primary" onclick="getLocation();"><i class="fa fa-location-arrow"></i> Get current location</button>
                                                                <input type="hidden" name="lat" id="lat">
                                                                <input type="hidden" name="long" id="long">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="billing-info">
                                                                <label>Full name</label>
                                                                <input type="text" required name="name" value="<?php echo $user[0]['username'];?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="billing-info">
                                                                <label>Phone number</label>
                                                                <input type="text" required name="phone" pattern="[6-9][0-9]{9}" value="<?php echo $user[0]['usermobile'];?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="billing-info">
                                                                <label>Address</label>
                                                                <input type="text" name="address" value="" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3">
                                                            <div class="billing-info">
                                                                <label>city</label>
                                                                <input type="text" value="" name="city" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3">
                                                            <div class="billing-info">
                                                                <label>Pin code</label>
                                                                <input type="text" maxlength="6" name="pincode" pattern="{0-9}" required>
                                                            </div>
                                                        </div><hr>
                                                        <div class="col-lg-4 col-md-4">
                                                            <div class="billing-info">
                                                                <label>Coupon Code</label>
                                                                <input type="text"  name="coupon" id="coupon-code">
                                                                <span class="text-danger coupon-msg"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4">
                                                            <div class="billing-back-btn">
                                                                <div class="billing-btn">
                                                                    <button type="button" class="btn-login" id="apply-coupon">Apply Coupon</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ship-wrapper">
                                                        <div class="single-ship">
                                                            <input type="radio" name="ptype" value="cod" checked>
                                                            <label>Cash on delivery</label>
                                                        </div>
                                                        <div class="single-ship">
                                                            <input type="radio" name="ptype" value="online">
                                                            <label>Pay with paytm</label>
                                                        </div>
    <!--                                                     <div class="single-ship">
                                                            <input type="radio" name="address" value="dadress">
                                                            <label>Ship to different address</label>
                                                        </div> -->
                                                    </div>
                                                    <div class="billing-back-btn">
                                                        <div class="billing-btn">
                                                            <button type="submit" class="btn-login">Place Order</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="checkout-progress">
                            <h4>My Cart</h4>
                            <ul>
                            <?php foreach ($attrArray as $key => $value) {?>
                                <li class="single-shopping-cart dishrow<?php echo $key;?>">
                                    <img alt="" src="<?php echo FRONT_DISH_IMAGE.$value['dish_img'];?>" height="50">
                                    <?php echo $value['dish_name'];?>
                                    <span style="padding: 0px 10px;">Qty: <?php echo $value['qty'];?></span> 
                                    <i class="fa fa-inr"></i> <?php echo $value['qty']*$value['price'];?>
                                    <?php $toatal += $value['qty']*$value['price'];?>
                                </li>                                
                            <?php } ?>
                            <li>
                                <div class="shopping-cart-total">
                                    <h4>Total : <span class="shop-total display-totalPrice">
                                        <i class="fa fa-inr"></i> <?php echo $toatal;?></span>
                                    </h4>
                                    <h4 class="coupon">Coupon : <span class="shop-total display-totalPrice coupon-amount"></span></h4>
                                    <h4 class="payable">Payable : <span class="shop-total display-totalPrice payable-amount"></span></h4>
                                </div>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 
    include("./inc/footer.php");
    include("./inc/js-links.php"); 
    unset($_SESSION['totalPay']);
    unset($_SESSION['COUPON']);    
    unset($_SESSION['COUPON_VALUE']);
?>
<script>
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
    $("#lat").val(position.coords.latitude);
    $("#long").val(position.coords.longitude);
}



</script>
</body>
</html>
<?php 
include("./inc/head.php");
if(isset($_POST['TXNID'])){
    $payment_id = $_POST['TXNID'];
    mysqli_query($con,"UPDATE `order_master` SET `payment_id`='$payment_id' WHERE `odmxid`='".$_SESSION['odmxid']."'");
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
                        <li class="active">success </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="about-us-area pt-100 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12  align-items-center">
                        <div class="overview-content-2">
                            <center>
                                <!-- <h3>Your Order Successfully Done On <span>Billy</span> Store !</h3> -->
                                <h2 class="peragraph-blog">Your Order ID  #<?php echo $_SESSION['odmxid'];?></h2>
                                <?php if(isset($_POST['TXNID'])){ ?>
                                    <h3>Paymeent Status: <?php echo $_POST['STATUS'];?></h3>
                                    <h3>Transaction ID: <?php echo $_POST['TXNID'];?></h3>
                                <?php } ?>
                                <div class="overview-btn mt-45">
                                    <a class="btn-style-2" href="dish.php">Shop now!</a>
                                </div>
                            </center>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
<?php 
    include("./inc/footer.php");
    include("./inc/js-links.php"); 
    // unset($_SESSION['odmxid']);
?>
</body>
</html>
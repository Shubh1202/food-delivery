<?php include("./inc/head.php"); ?>
    <title>Khatejao.com</title>
    <style>
        .box{
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
            padding: 15px;
            border-radius: 15px;
            margin: 10px 0px;
        }
        .box .divider{
            border-bottom: 1px solid #ddd;
            margin:15px 0px;
        }
        .head .text-right{float:  right;}
        .order-content span{
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 12px;
        }
        .order-content{
            margin: 8px 0px;
        }
        .footer{
            border-top: 1px solid #ddd;
            padding-top:  15px;
            text-align: right;
        }
    </style>
</head>
<body>
<?php include("./inc/header.php"); ?>
        <div class="breadcrumb-area gray-bg">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Order History </li>
                    </ul>
                </div>
            </div>
        </div>
         <!-- shopping-cart-area start -->
        <div class="cart-main-area pt-95 pb-100">
            <div class="container">
                <h3 class="page-title">My orders</h3>
                <div class="row">
                    <?php
                    $uxid = $_SESSION['uxid'];
                    $orderMaster = getOrderMaster($uxid);
                    foreach ($orderMaster as $value) {
                    ?>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                        <div class="box">
                            <div class="head">
                                <strong>Order Detail</strong>
                                <span class="text-right">
                                    <?php if($value['order_status']=="pending"){?>
                                        <span class="badge badge-danger">Pending</span>
                                    <?php } else if($value['order_status']=="delivered"){ ?>
                                        <span class="badge badge-success">Delivered</span>
                                    <?php } else { ?>
                                        <span class="badge badge-primary"><?php echo ucwords($value['order_status']);?></span>
                                    <?php } ?>
                                </span>
                            </div>
                            <div class="divider"></div>
                            <div class="order-body">
                                <div class="order-content">
                                    <span class="text-muted">Order Number</span><br>
                                    <?php echo $value['odmxid'];?>
                                </div>
                                <div class="order-content">
                                    <span class="text-muted">Total Amount</span><br>
                                    <i class="fa fa-inr"></i> <?php echo $value['total_price'].".00";?>
                                </div>
                                <div class="order-content">
                                    <span class="text-muted">Dish items</span><br>
                                <?php 
                                    $orderDish = orderDish($value['odmxid']);
                                    foreach ($orderDish as $result) {
                                ?>
                                    <i class="fa fa-dot-circle-o <?php echo $result['dish_type'];?>"></i>
                                    <?php echo $result['order_qty']." x ".$result['dish_name'];?> (<?php echo  $result['qty'];?>)<br>
                                <?php } ?>
                                </div>
                                <div class="order-content">
                                    <span class="text-muted">Order On</span><br>
                                    <?php echo $value['order_date'];?>
                                </div>
                            </div>
                            <!-- Delivery boy -->
                            <?php if(!empty($value['delivery_boy']) && $value['order_status'] !="delivered"){?>
                            <div class="footer" style="text-align: left;">
                                <img src="images/delivery-boy.jpg" width="50" height="50">
                                <?php
                                if(empty($value['delivery_boy'])){
                                    $delivery_boy = "Not assign";
                                }else if(!empty($value['delivery_boy'])){
                                    $boy = get_delivery_boy($value['delivery_boy']);
                                    $delivery_boy = $boy[0]['boyname']." - ".$boy[0]['boymobile'];
                                }
                                echo $delivery_boy;
                                ?>                
                            </div><br>
                            <?php } ?>
                            <div class="footer">
                                <a href="javascript:;" data-toggle="modal" data-target="#exampleModal<?php echo $value['odmxid'];?>">View Detail</a>
                            </div>
                        </div>
                    </div>
                    </a>

                    <!-- modal box -->

                    <div class="modal fade" id="exampleModal<?php echo $value['odmxid'];?>"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Order Summary</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="divider"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
            </div>
        </div>
<?php 
    include("./inc/footer.php");
    include("./inc/js-links.php"); 
?>
</body>
</html>
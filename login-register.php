<?php include("./inc/head.php"); ?>
    <title>Login Or Register || <?php echo $website; ?></title>
</head>
<body>
<?php include("./inc/header.php"); ?>
        <div class="breadcrumb-area gray-bg">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li class="active"> Login Or Register </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="login-register-area pt-95 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <a class="active" data-toggle="tab" href="#lg1">
                                    <h4> login </h4>
                                </a>
                                <a data-toggle="tab" href="#lg2">
                                    <h4> register </h4>
                                </a>
                            </div>
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form action="#" method="post" id="frmLogin">
                                                <input type="text" name="user_email" placeholder="Useremail" required>
                                                <input type="password" name="user_password" placeholder="Password" required>
                                                <div class="button-box">
                                                    <div class="login-toggle-btn">
                                                        <a href="search-account.php">Forgot Password?</a>
                                                    </div>
                                                    <button type="submit" id="btn-login"><span>Login</span></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="lg2" class="tab-pane">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form action="" method="post" id="frmRegister">
                                                <input type="text" name="name" placeholder="Name*" required="">
                                                <input type="email"name="email" placeholder="Email*" required="" id="email">
                                                <span class="text-danger email-err"></span>
                                                <input type="text"name="phone" placeholder="Phone Number*" required="" maxlength="10" pattern="[6-9][0-9]{9}">
                                                <input type="password" name="user-password" placeholder="Password" required="">
                                                <div class="button-box">
                                                    <button type="submit" id="btn-register"><span>Register</span></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/themify/themify-icons.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/elegant-font/html-css/style.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/lightbox2/css/lightbox.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body class="animsition">

     <!-- Header -->
     <?php
	include("includes/testheader.php");
    ?>


    
    <!-- Slide1 -->
    <!--End of Header Area-->

      <div class="contentforlayout">
          <br>
        <!--My Account Content Area Start-->    
  <div class="container">
    <div class="row">
      <div id="content" class="col-sm-12">
        <div class="row">
          
          <div class="alert alert-danger" style="display:none;">
            <i class="fa fa-exclamation-circle"></i>
            Email hoặc mật khẩu không hợp lệ.
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="well">
              <h2>Chưa có tài khoản?</h2>


              <br/>
              <a href="signup.html" id="button-account" class="btn btn-primary">Tạo tài khoản</a>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="well">
              <h2>Đăng nhập</h2>
 
              <form method="post" action="login.php" id="customer_login" accept-charset="UTF-8"><input type="hidden" name="form_type" value="customer_login" /><input type="hidden" name="utf8" value="✓" />

              
              <div class="form-group">
                <label class="control-label" for="username">Username</label>
                <input type="text" value="" name="username" id="username" placeholder="Username"  class="form-control"  autocorrect="off" autocapitalize="off" autofocus>
              </div>
              
              <div class="form-group">
                <label class="control-label" for="customer_password">Mật khẩu</label>
                <input class="form-control" type="password" value="" name="password" id="password" placeholder="Password"  class="form-control">
                <!-- <a rel="nofollow" href="#" >Quên mật khẩu?</a> -->
              </div>
             
              <div class="submit">                  
                <button name="account" type="button" id="button-account" class="btn btn-primary" onclick="login()">
                  <span>
                    <i class="fa fa-user left"></i>
                    Đăng nhập
                  </span>
                </button>                                 &nbsp;
               
      
              </div>
              <input type="hidden" name="return_url" value="/account?fbclid=IwAR0RfYye78Euj9UE7zQjN_9LmdBkCNbOzVpnvBd8NVXeZpPOz0fuuUknKT8" /></form>      
             

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--End of My Account Content Area-->
  
  <script>
    /*
        validate formats then submit
    */
    function login() {  
        
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        if (username.length ==0) {
                alert("Xin vui lòng nhập một địa chỉ email");
                return;
        }
        if (password.length <2 || password.length>30) {
                alert("Mật khẩu quá ngắn hoặc quá dài");
                return;
        }

        /*const email_format = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(!email_format.test(String(email).toLowerCase())) {
            alert("Email không hợp lệ!");
            return;
        }*/
        document.getElementById("customer_login").submit();
        
    }
    /*
      Show/hide the recover password form when requested.
    */
 
    
  </script>
  
        <!-- End Content -->  
    <!-- Footer -->
    <footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
        <div class="flex-w p-b-90">
            <div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
                <h4 class="s-text12 p-b-30">
                    Liên lạc
                </h4>

                <div>
                    <p class="s-text7 w-size27">
                        Nếu bạn có đề xuất gì? Bạn có thể đến trực tiếp thư viện tại H1
                    </p>
                </div>
            </div>

            
           

        </div>

        
    </footer>



    <!-- Back to top -->
    <div class="btn-back-to-top bg0-hov" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="fa fa-angle-double-up" aria-hidden="true"></i>
        </span>
    </div>

    <!-- Container Selection1 -->
    <div id="dropDownSelect1"></div>



<!--===============================================================================================-->
    <script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
    <script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script type="text/javascript" src="vendor/select2/select2.min.js"></script>
    <script type="text/javascript">
        $(".selection-1").select2({
            minimumResultsForSearch: 20,
            dropdownParent: $('#dropDownSelect1')
        });
    </script>
<!--===============================================================================================-->
    <script type="text/javascript" src="vendor/slick/slick.min.js"></script>
    <script type="text/javascript" src="js/slick-custom.js"></script>
<!--===============================================================================================-->
    <script type="text/javascript" src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
    <script type="text/javascript" src="vendor/lightbox2/js/lightbox.min.js"></script>
<!--===============================================================================================-->
    <script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
    <!--<script type="text/javascript">
        $('.block2-btn-addcart').each(function(){
            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            $(this).on('click', function(){
                swal(nameProduct, "is added to cart !", "success");
            });
        });

        $('.block2-btn-addwishlist').each(function(){
            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            $(this).on('click', function(){
                swal(nameProduct, "is added to wishlist !", "success");
            });
        });
    </script>>-->

<!--===============================================================================================-->
    <script src="js/main.js"></script>

</body>
</html>

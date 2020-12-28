<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tài khoản của bạn</title>
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
    <div class="container">
        <div class="panel-group" id="accordion">
        <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Sách đã mượn</h2>
        </div>
        <table class="table table-hover" accept-charset="UTF-8">
            <thead>
                <tr>
                <th scope="col">ID sách</th>
                <th scope="col">Tên sách</th>
                <th scope="col">Giá</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Ngày mượn</th>
                <th scope="col">Ngày trả</th>
                </tr>
            </thead>
            <tbody>
                <!-- connect to database -->
                <?php
      $tns = " 
      (DESCRIPTION =
          (ADDRESS_LIST =
            (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
          )
          (CONNECT_DATA =
            (SERVICE_NAME = XE)
          )
        )
            ";
      $db_username = "demo";
      $db_password = "123";
      $conn = new PDO("oci:dbname=".$tns. ";charset=UTF8",$db_username,$db_password);
      $conn->exec("set names utf8");
      $stmt = $conn->prepare("SELECT BORROW.IDBOOK, BOOK.BNAME, BOOK.PRICE, BORROW.QUANTITY, BORROW.DATE_TIME, BORROW.GIVEBACK_TIME FROM BORROW, BOOK
      WHERE BORROW.IDPEOPLE = ".$_SESSION["id"]." AND BORROW.IDBOOK = BOOK.IDBOOK");

      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $stmt->execute();
      $resultSet = $stmt->fetchAll();
        foreach ($resultSet as $row) {
        
        echo '<tr>';
        echo '<td>' . $row['IDBOOK'] . '</td>';
        echo '<td>' . $row['BNAME'] . '</td>';
        echo '<td>' . $row['PRICE'] . '</td>';
        echo '<td>' . $row['QUANTITY'] . '</td>';
        echo '<td>' . $row['DATE_TIME'] . '</td>';
        echo '<td>' . $row['GIVEBACK_TIME'] . '</td>';
        echo '<tr>';
        
        }
        ?>

            </tbody>
        </table>
        </div>
        </div>

    </div>
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
<?php
session_start();
if ($_SESSION["role"] != 4){
    echo "<script>
        alert('Bạn không đủ quyền vào trang này!');
        location.href= 'book.php';
        </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Management</title>
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
    <!--Body of page-->
    <div class = "container">
        <!-- về sách đã mượn -->
        <div class="panel-group" id="accordion">
        <div class="panel panel-default">
        <div class="panel-heading">            
        <button class="btn btn-link btn-block collapsed" type="button" data-toggle="collapse" data-target="#borrowbook">
            <h4>Về sách đã mượn</h4></button>   
        </div>
            <div id="borrowbook" class="collapse">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#confirm">Xác nhận trả sách</button>
            <div class="modal fade" id="confirm" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Trả sách</h5>
                </div>
                <div class="modal-body">
                    <form method="post" action="confirm.php">
                        <div class="form-group">
                        <label>ID sách: </label>
                        <input class="form-control" id="idbook_back" name="idbook_back"  placeholder="231">
                        </div>
                        <div class="form-group">
                        <label>ID người dùng: </label>
                        <input class="form-control" id="iduser_back" name="iduser_back"  placeholder="231">
                        </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-default btn-danger">Xác nhận</button>
                    </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
                </div>
                </div>
            </div>
            </div>
            <table class="table table-hover" accept-charset="UTF-8">
                <thead>
                    <tr>
                    <th scope="col">ID sách</th>
                    <th scope="col">ID người dùng</th>
                    <th scope="col">Ngày mượn</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Ngày trả</th>
                    <th scope="col">Tiền phạt</th>
                    
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
      $stmt = $conn->prepare('SELECT * from BORROW');

      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $stmt->execute();
      $resultSet = $stmt->fetchAll();
                    foreach ($resultSet as $row) {                    
                    echo '<tr>';
                    echo '<td>' . trim($row['IDBOOK']) . '</td>';
                    echo '<td>' . trim($row['IDPEOPLE']) . '</td>';
                    echo '<td>' . trim($row['DATE_TIME']) . '</td>';
                    echo '<td>' . trim($row['QUANTITY']) . '</td>';
                    echo '<td>' . trim($row['GIVEBACK_TIME']) . '</td>';
                    echo '<td>' . trim($row['PUNISHMENT']) . '</td>';
                    echo '<tr>';                    
                    }
?>
                </tbody>
            </table>          
            </div>            
        </div>
        </div>
        <!-- về người dùng -->
        <div class="panel-group" id="accordion">
        <div class="panel panel-default">
        <div class="panel-heading">
        
        <button class="btn btn-link btn-block collapsed" type="button" data-toggle="collapse" data-target="#user">
            <h4>Về người dùng</h4></button>       
        </div>
            <div id="user" class="collapse">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addUser">Thêm người dùng</button>               
                <div class="modal fade" id="addUser" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Thêm người dùng</h5>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="addUser.php">
                        <div class="form-group required">
                            <label>Chức vụ: </label>
                                <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="role" id="student" value="1" checked>Sinh viên
                                </label>
                                </div>
                                <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="role" id="teacher" value="2">Giảng viên
                                </label>
                                </div>
                                <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="role" id="guest" value="3">Khách
                                </label>
                                </div>
                        </div>
                        <div class="form-group required">
                            <label>Họ và tên:</label>
                            <input type="text" class="form-control" id="NameUser" name="NameUser"  placeholder="Nguyễn Văn A">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="EmailUser" name="EmailUser"  placeholder="A.nguyen@hcmut.edu.vn">
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại:</label>
                            <input class="form-control" id="PNUser" name="PNUser" placeholder="0987654321">
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default btn-danger">Thêm</button>
                        </form>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    </div>
                    </div>
                    
                </div>
                </div>    
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteUser">Xóa người dùng</button>  
            <div class="modal fade" id="deleteUser" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Xóa người dùng</h5>
                </div>
                <div class="modal-body">
                    <form method="post" action="deleteUser.php">
                        <div class="form-group">
                        <label>ID: </label>
                        <input class="form-control" id="IdUser_del" name="IdUser_del"  placeholder="1810001">
                        </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-default btn-danger">Xóa</button>
                    </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
                </div>
                </div>
            </div>
            </div>    
            <table class="table table-hover" accept-charset="UTF-8">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Chức vụ</th>
                    <th scope="col">Họ và tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
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
      $stmt = $conn->prepare('SELECT * FROM USER_LIT');

    //   $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $stmt->execute();
      $resultSet = $stmt->fetchAll();
                    foreach ($resultSet as $row) {
                    
                    echo '<tr>';
                    echo '<td>' . $row['IDPEOPLE'] . '</td>';
                    echo '<td>';
                        if ($row['ROLE_U'] == 1) echo 'Sinh Viên';
                        if ($row['ROLE_U'] == 2) echo 'Giảng Viên';
                        if ($row['ROLE_U'] == 3) echo 'Khách';
                        if ($row['ROLE_U'] == 4) echo 'Thủ THư';
                    echo '</td>';
                    echo '<td>' . $row['PNAME'] . '</td>';
                    echo '<td>' . $row['EMAIL'] . '</td>';
                    echo '<td>' . $row['PHONENUMBER'] . '</td>';
                    echo '<tr>';
                    
                    }
$conn=null;
                    ?>
                </tbody>
            </table>          
            </div>            
        </div>
        </div>
        <!-- về sách book-->
        <div class="panel-group" id="accordion">
        <div class="panel panel-default">
        <div class="panel-heading">            
        <button class="btn btn-link btn-block collapsed" type="button" data-toggle="collapse" data-target="#book">
            <h4>Về sách</h4></button>       
        </div>
            <div id="book" class="collapse">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addBook">Thêm sách</button>               
                <div class="modal fade" id="addBook" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Thêm sách</h5>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="addBook.php">
                        <div class="form-group">
                            <label>Tên sách:</label>
                            <input type="text" class="form-control" id="NameBook"  name="NameBook"  placeholder="Giải tích 1">
                        </div>
                        <div class="form-group">
                            <label>Giá tiền:</label>
                            <input class="form-control" id="PriceBook"  name="PriceBook"  placeholder="20000">
                        </div>
                        <div class="form-group">
                            <label>Số bản hiện có:</label>
                            <input class="form-control" id="NumOfCopy"  name="NumOfCopy"  placeholder="0">
                        </div>
                        <div class="form-group">
                            <label>Tác giả:</label>
                            <input class="form-control" id="author"  name="author">
                        </div> 
                        <div class="form-group">
                            <label>Nhà xuất bản:</label>
                            <input class="form-control" id="publisher"  name="publisher">
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default btn-danger">Thêm</button>
                        </form>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    </div>
                    </div>
                    
                </div>
                </div>    
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteBook">Xóa sách</button>  
            <div class="modal fade" id="deleteBook" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Xóa sách</h5>
                </div>
                <div class="modal-body">
                    <form method="post" action="deleteBook.php">
                        <div class="form-group">
                        <label>ID: </label>
                        <input class="form-control" id="IdBook_del" name="IdBook_del"  placeholder="0001">
                        </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-default btn-danger">Xóa</button>
                    </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
                </div>
                </div>
            </div>
            </div>    
            <table class="table table-hover" accept-charset="UTF-8">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên sách</th>
                    <th scope="col">Giá tiền</th>
                    <th scope="col">Số bản hiện có</th>
                    <th scope="col">NXB</th>
                    <th scope="col">Tác giả</th>
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
      $stmt = $conn->prepare('SELECT * from BOOK');

      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $stmt->execute();
      $resultSet = $stmt->fetchAll();
        foreach ($resultSet as $row) {
        
        echo '<tr>';
        echo '<td>' . $row['IDBOOK'] . '</td>';
        echo '<td>' . $row['BNAME'] . '</td>';
        echo '<td>' . $row['PRICE'] . '</td>';
        echo '<td>' . $row['NUMBER_OF_COPY'] . '</td>';
        $stmt = $conn->prepare("SELECT namep FROM publisher, ispublished WHERE ispublished.idbook = '".$row['IDBOOK']."' and ispublished.idpub = publisher.idpub");
        $stmt->execute();
        $publisher_row = $stmt->fetchAll();        
        // echo '<td>' . $publisher_row[0]['NAMEP'] . '</td>';
        echo '<td>' ;
            $arrlength = count($publisher_row);
            for($x = 0; $x < $arrlength; $x++) {
            echo $publisher_row[$x]['NAMEP'];
            if ($x == $arrlength - 1){}
            else echo "; ";
        }
        echo '</td>';
        $stmt = $conn->prepare("SELECT namea FROM author, iswritten WHERE iswritten.idbook = '".$row['IDBOOK']."' and iswritten.idauthor = author.idauthor");
        $stmt->execute();
        $author_col = $stmt->fetchAll();
        echo '<td>' ;
            $arrlength = count($author_col);
            for($x = 0; $x < $arrlength; $x++) {
            echo $author_col[$x]['NAMEA'];
            if ($x == $arrlength - 1){}
            else echo "; ";
        }
        echo '</td>';
        echo '<tr>';
        
        }
        ?>
                </tbody>
            </table>          
            </div>        
            </div> 
        </div>
        <!-- về nhà sản xuát -->
        <div class="panel-group" id="accordion">
        <div class="panel panel-default">
        <div class="panel-heading">            
        <button class="btn btn-link btn-block collapsed" type="button" data-toggle="collapse" data-target="#publisher_col">
            <h4>Về nhà sản xuất</h4></button>       
        </div>
            <div id="publisher_col" class="collapse">
            <table class="table table-hover" accept-charset="UTF-8">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên nhà sản xuất</th>
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
      $stmt = $conn->prepare('SELECT * from PUBLISHER');

      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $stmt->execute();
      $resultSet = $stmt->fetchAll();
                    foreach ($resultSet as $row) {                    
                    echo '<tr>';
                    echo '<td>' . trim($row['IDPUB']) . '</td>';
                    echo '<td>' . trim($row['NAMEP']) . '</td>';
                    echo '<tr>';                    
                    }
?>
                </tbody>
            </table>          
            </div>            
        </div>
        </div>

    <!-- về TÁC GIẢ -->
    <div class="panel-group" id="accordion">
            <div class="panel panel-default">
            <div class="panel-heading">            
            <button class="btn btn-link btn-block collapsed" type="button" data-toggle="collapse" data-target="#author_col">
                <h4>Về tác giả</h4></button>       
            </div>
                <div id="author_col" class="collapse">
                <table class="table table-hover" accept-charset="UTF-8">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tên tác giả</th>
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
        $stmt = $conn->prepare('SELECT * from AUTHOR');

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $resultSet = $stmt->fetchAll();
                        foreach ($resultSet as $row) {                    
                        echo '<tr>';
                        echo '<td>' . trim($row['IDAUTHOR']) . '</td>';
                        echo '<td>' . trim($row['NAMEA']) . '</td>';
                        echo '<tr>';                    
                        }
    ?>
                    </tbody>
                </table>          
                </div>            
            </div>
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
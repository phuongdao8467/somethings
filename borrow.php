<?php
session_start();
if (isset($_SESSION["isloggin"]) == false){
    echo "<script>
        alert('Bạn cần đăng nhập để mượn sách!');
        location.href= 'index.php';
        </script>";
}
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
    try{
        $conn = new PDO("oci:dbname=".$tns. ';charset=UTF8',$db_username,$db_password);
    }catch(PDOException $e){
        echo ($e->getMessage());
    }
    $IDBOOK = $_POST["idbook"];
    $QUANTITY = $_POST["quantity"];
    $IDPEOPLE = $_SESSION["id"];
    $DATE = date("d/m/Y");
    $DURATION = 14;
    if ($_SESSION["role"] == 1 or $_SESSION["role"] == 3){
        $DURATION = 7;
    }

    $stmt = $conn->prepare("SELECT NUMBER_OF_COPY FROM BOOK WHERE IDBOOK = ".$IDBOOK."");
    $stmt->execute();
    $resultSet = $stmt->fetchAll();
    $OLD_QUANTITY = $resultSet[0]["NUMBER_OF_COPY"];
    if ($OLD_QUANTITY < $QUANTITY){
        echo "<script>
        alert('Không đủ sách cho bạn mượn! Hãy nhập lại số lượng!');
        location.href= 'book.php';
        </script>";
    }
    else{

    

    $stmt = $conn->prepare("INSERT INTO BORROW (IDBOOK, IDPEOPLE, DATE_TIME, DURATION_, QUANTITY) VALUES (:IDB, :IDP, to_date('".$DATE ."','DD/MM/YYYY'),:DU,:QU)");
    $stmt->bindParam(':IDB', $IDBOOK);
    $stmt->bindParam(':IDP', $IDPEOPLE);
    $stmt->bindParam(':DU', $DURATION);
    $stmt->bindParam(':QU', $QUANTITY);
    $stmt->execute();
    // update quantity after borrow
    
    $NEW_QUANTITY = $OLD_QUANTITY - $QUANTITY;
    $stmt = $conn->prepare("UPDATE BOOK SET NUMBER_OF_COPY = ".$NEW_QUANTITY." WHERE IDBOOK = ".$IDBOOK."");    
    $conn = null;
    if ($stmt->execute()){
        echo "<script>
        alert('Đã mượn sách!');
        location.href= 'book.php';
        </script>";
    }
    else{
        echo "<script>
        alert('Thất bại!');
        location.href= 'book.php';
        </script>";
        // print_r($stmt->errorInfo());
    }
    }
?>
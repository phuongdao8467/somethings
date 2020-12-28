<?php
session_start();
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
    $IDBOOK = trim($_POST["idbook_back"]);
    $IDUSER = trim($_POST["iduser_back"]);
    $DATE = date("d/m/Y");
    // check book is give back??
    $stmt = $conn->prepare("SELECT GIVEBACK_TIME FROM BORROW WHERE IDBOOK = ".$IDBOOK." AND IDPEOPLE = ".$IDUSER."");
    $stmt->execute();
    $resultSet = $stmt->fetchAll();
    if ($resultSet){
        echo "<script>
        alert('Sách đã được trả!');
        location.href= 'management.php';
        </script>";
    }
    else{}

    $stmt = $conn->prepare("UPDATE BORROW SET GIVEBACK_TIME = TO_DATE('".$DATE ."','DD/MM/YYYY') WHERE IDBOOK = ".$IDBOOK." AND IDPEOPLE = ".$IDUSER."");    
    $stmt->execute();
    // update quantity after give back book
    $stmt = $conn->prepare("SELECT NUMBER_OF_COPY FROM BOOK WHERE IDBOOK = ".$IDBOOK."");
    $stmt->execute();
    $resultSet = $stmt->fetchAll();
    $OLD_QUANTITY = $resultSet[0]["NUMBER_OF_COPY"];

    $stmt = $conn->prepare("SELECT QUANTITY FROM BORROW WHERE IDBOOK = ".$IDBOOK." AND IDPEOPLE = ".$IDUSER."");
    $stmt->execute();
    $resultSet = $stmt->fetchAll();
    $GIVEBACK_QUANTITY = $resultSet[0]["QUANTITY"];

    $NEW_QUANTITY = $OLD_QUANTITY + $GIVEBACK_QUANTITY;
    $stmt = $conn->prepare("UPDATE BOOK SET NUMBER_OF_COPY = ".$NEW_QUANTITY." WHERE IDBOOK = ".$IDBOOK."");    
    
    $conn = null;
    if ($stmt->execute()){
        echo "<script>
        alert('Đã trả sách!');
        location.href= 'management.php';
        </script>";
    }
    else{
        echo "<script>
        alert('Thất bại!');
        location.href= 'management.php';
        </script>";
        // print_r($stmt->errorInfo());
    }

?>
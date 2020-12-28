
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
      try{
            $conn = new PDO("oci:dbname=".$tns. ';charset=UTF8',$db_username,$db_password);
        }catch(PDOException $e){
            echo ($e->getMessage());
        }
      $IDBOOK = trim($_POST["IdBook_del"]);
      //$conn = $this->getConnection();
      $stmt = $conn->prepare("DELETE FROM ISWRITTEN WHERE IDBOOK = '$IDBOOK'");  
      $stmt->execute();
      $stmt = $conn->prepare("DELETE FROM ISPUBLISHED WHERE IDBOOK = '$IDBOOK'");
      $stmt->execute();
      $stmt = $conn->prepare("DELETE FROM BOOK WHERE IDBOOK = '$IDBOOK'");
      $stmt->execute();
      $cou = $stmt->rowCount();
      $conn=null;
      if ($cou > 0){
        echo "<script>
        alert('Đã xóa!');
        location.href= 'management.php';
        </script>";
      }
      else{
        print_r($stmt->errorInfo());
      }
      //header("Location: management.php");
?>

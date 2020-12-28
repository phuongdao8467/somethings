
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
      $IDPEOPLE = $_POST["IdUser_del"];
      //$conn = $this->getConnection();
      $stmt = $conn->prepare("DELETE FROM USER_LIT 
                    WHERE IDPEOPLE = '".$IDPEOPLE."'");      
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
        echo "<script>
        alert('Không tìm thấy người hoặc id nhập sai!');
        location.href= 'management.php';
        </script>";
      }
      //header("Location: management.php");
?>

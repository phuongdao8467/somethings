
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
      $ROLE_U = $_POST["role"];
      $PNAME = $_POST["NameUser"];
      $EMAIL = $_POST["EmailUser"];
      $PHONENUMBER = $_POST["PNUser"];
      $IDBOOK = null;
      $stmt = $conn->prepare("INSERT INTO USER_LIT (IDPEOPLE ,USERNAME, PASSWORD_U, ROLE_U, PNAME, EMAIL, PHONENUMBER, IDBOOK) VALUES (user_seq.NEXTVAL, user_seq.NEXTVAL , user_seq.NEXTVAL, :ROLE_U_P, :PNAME_P, :EMAIL_P, :PHONENUMBER_P, :IDBOOK_P)");
      $stmt->bindParam(':ROLE_U_P', $ROLE_U, PDO::PARAM_INT);
      $stmt->bindParam(':PNAME_P', $PNAME, PDO::PARAM_STR);
      $stmt->bindParam(':EMAIL_P', $EMAIL, PDO::PARAM_STR);
      $stmt->bindParam(':PHONENUMBER_P', $PHONENUMBER, PDO::PARAM_STR);     
      $stmt->bindParam(':IDBOOK_P', $IDBOOK, PDO::PARAM_STR); 
      
      
      $conn=null;
      if ($stmt->execute()){
        echo "<script>
        alert('Thành công!');
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

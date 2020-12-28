
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
      $NAMEBOOK = trim($_POST["NameBook"]);
      $PRICE = (int)trim($_POST["PriceBook"]);
      $NUMOFCOPY = (int)trim($_POST["NumOfCopy"]);
      $AUTHOR = trim($_POST["author"]);
      $PUBLISHER = trim($_POST["publisher"]);
      
      $LPUBLISHER = explode(",", $PUBLISHER);
      $LSTAUTHOR = explode(",", $AUTHOR);
      $succ = true;
      // insert book into table book
      $stmt = $conn->prepare("INSERT INTO BOOK (IDBOOK, BNAME, PRICE, NUMBER_OF_COPY) VALUES (user_seq.NEXTVAL, :BNAME_P, :PRICE_P, :NUM_P)");
      $stmt->bindParam(':BNAME_P', $NAMEBOOK);
      $stmt->bindValue(':PRICE_P', $PRICE);
      $stmt->bindValue(':NUM_P', $NUMOFCOPY);
      if($stmt->execute()) $succ = true;
      else $succ = false;
      
      // insert publisher into table publisher - check exist publisher
      // $stmt = $conn->prepare("SELECT NAMEP FROM PUBLISHER WHERE NAMEP = '$PUBLISHER'");
      // $stmt->execute();
      // $check = $stmt->fetch(PDO::FETCH_OBJ);
      
      // if ($check){
      // }
      // else{        
      //   $stmt = $conn->prepare("INSERT INTO PUBLISHER (IDPUB, NAMEP) VALUES (user_seq.NEXTVAL, :NAMEP_P)");
      //   $stmt->bindParam(':NAMEP_P', $PUBLISHER);
        
      //   if ($stmt->execute()) {
      //     // $succ = true;
      //   }
      //   else {
      //     $succ = false;
      //   }
      // }

      $succ_p = true;
      foreach ($LPUBLISHER as $au){
        $stmt = $conn->prepare("SELECT NAMEP FROM PUBLISHER WHERE NAMEP = '$au'");
        $stmt->execute();
        $check = $stmt->fetch(PDO::FETCH_OBJ);
        
        if ($check){
        }
        else{        
          $stmt = $conn->prepare("INSERT INTO PUBLISHER (IDPUB, NAMEP) VALUES (user_seq.NEXTVAL, :NAMEA_A)");
          $stmt->bindParam(':NAMEA_A', $au);
          
          if ($stmt->execute()) {
            // $succ_a = true;
          }
          else {
            $succ_p = false;
          }
        }
      }

      // INSERT into ispublished
      // $stmt = $conn->prepare("SELECT * FROM PUBLISHER WHERE NAMEP = '$PUBLISHER'");
      // $stmt->execute();
      // $pcheck = $stmt->fetch(PDO::FETCH_OBJ);
      // $IDPUB_NEW = $pcheck->IDPUB;
      // $stmt = $conn->prepare("SELECT * FROM BOOK WHERE BNAME = '$NAMEBOOK'");
      // $stmt->execute();
      // $bcheck = $stmt->fetch(PDO::FETCH_OBJ);
      // $IDBOOK_NEW = $bcheck->IDBOOK;
      // $stmt = $conn->prepare("INSERT INTO ISPUBLISHED (IDBOOK, IDPUB) VALUES (:IDB, :IDP)");
      // $stmt->bindParam(':IDB', $IDBOOK_NEW);
      // $stmt->bindParam(':IDP', $IDPUB_NEW);
      // $stmt->execute();

      $stmt = $conn->prepare("SELECT * FROM BOOK WHERE BNAME = '$NAMEBOOK'");
      $stmt->execute();
      $bcheck = $stmt->fetch(PDO::FETCH_OBJ);
      $IDBOOK_NEW = $bcheck->IDBOOK;
      foreach ($LPUBLISHER as $au){
        $stmt = $conn->prepare("SELECT * FROM PUBLISHER WHERE NAMEP = '$au'");
        $stmt->execute();
        $acheck = $stmt->fetch(PDO::FETCH_OBJ);
        $IDAU_NEW = $acheck->IDPUB;        
        $stmt = $conn->prepare("INSERT INTO ISPUBLISHED (IDBOOK, IDPUB) VALUES (:IDB, :IDA)");
        $stmt->bindParam(':IDB', $IDBOOK_NEW);
        $stmt->bindParam(':IDA', $IDAU_NEW);
        $stmt->execute();
      }

      // insert author into table author - check exist author
      $succ_a = true;
      foreach ($LSTAUTHOR as $au){
        $stmt = $conn->prepare("SELECT NAMEA FROM AUTHOR WHERE NAMEA = '$au'");
        $stmt->execute();
        $check = $stmt->fetch(PDO::FETCH_OBJ);
        
        if ($check){
        }
        else{        
          $stmt = $conn->prepare("INSERT INTO AUTHOR (IDAUTHOR, NAMEA) VALUES (user_seq.NEXTVAL, :NAMEA_A)");
          $stmt->bindParam(':NAMEA_A', $au);
          
          if ($stmt->execute()) {
            // $succ_a = true;
          }
          else {
            $succ_a = false;
          }
        }
      }

      // INSERT into iswritten
      $stmt = $conn->prepare("SELECT * FROM BOOK WHERE BNAME = '$NAMEBOOK'");
      $stmt->execute();
      $bcheck = $stmt->fetch(PDO::FETCH_OBJ);
      $IDBOOK_NEW = $bcheck->IDBOOK;
      foreach ($LSTAUTHOR as $au){
        $stmt = $conn->prepare("SELECT * FROM AUTHOR WHERE NAMEA = '$au'");
        $stmt->execute();
        $acheck = $stmt->fetch(PDO::FETCH_OBJ);
        $IDAU_NEW = $acheck->IDAUTHOR;        
        $stmt = $conn->prepare("INSERT INTO ISWRITTEN (IDBOOK, IDAUTHOR) VALUES (:IDB, :IDA)");
        $stmt->bindParam(':IDB', $IDBOOK_NEW);
        $stmt->bindParam(':IDA', $IDAU_NEW);
        $stmt->execute();
      }
      
      if ($succ and $succ_a){
      echo "<script>
      alert('Thành công!');
      location.href= 'management.php';
      </script>";
      }
      else{
        print_r($stmt->errorInfo());
      }

?>

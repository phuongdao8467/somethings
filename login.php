<?php
session_start();
include 'conn.php';
/**
 * Class UserClass
 */
$_SESSION["isloggin"] = false;
if (isset($_POST['password'])){
	$password=trim($_POST['password']);	
	
}
if (isset($_POST['username'])){
	$username=trim($_POST['username']);
	
}
$conn = connectDB();
$query = 'SELECT * FROM USER_LIT WHERE username = :u AND password_u = :p';
$stmt = $conn->prepare($query); // prepare
$stmt->bindParam(':u', $username);
$stmt->bindValue(':p', $password);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_OBJ);
if ($data){	
	$role = $data -> ROLE_U;
	$_SESSION["role"] = $role;
	$_SESSION["isloggin"] = true;
	$_SESSION["id"] = $data->IDPEOPLE;
	$_SESSION["name"] = $data->PNAME;
	switch ($role) {
	 	case '4':
	 		header("Refresh:0; url=management.php");
	 		break;	
	 	case '1':
			echo "<script>
			alert('Đăng nhập thành công');
			location.href= 'book.php';
			</script>";
	 		break;
	 	case '2':
			echo "<script>
			alert('Đăng nhập thành công');
			location.href= 'book.php';
			</script>";
	 		break;
	 	case '3':
			echo "<script>
			alert('Đăng nhập thành công');
			location.href= 'book.php';
			</script>";
	 		break; 	 	
	 	}

}
else{
	?>
	<script type="text/javascript">
		alert("Sai thông tin đăng nhập");
	</script>
	<?php	
	header("Refresh:0; url=index.php");
}

?>



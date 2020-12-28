<?php 

include 'conn.php';
if (isset($_POST['username'])){
	$username=trim($_POST['username']);
	
}
if (isset($_POST['password'])){
	$password=trim($_POST['password']);	
	
	
}

if (isset($_POST['sel'])){
	$sel=trim($_POST['sel']);		
	switch ($sel) {
	case "stu":
		$role=1;
		break;
	case "tea":
		$role=2;
		break;
	case "gue":
		$role =3;
		break;	
	}
}

if (isset($_POST['name'])){
	$pname=trim($_POST['name']);	
}
if (isset($_POST['email'])){
	$email=trim($_POST['email']);	
}
if (isset($_POST['phoneNumber'])){
	$phonenumber=trim($_POST['phoneNumber']);	
}

$conn = connectDB();
$stmt_check=$conn->prepare('SELECT USERNAME FROM user_lit WHERE USERNAME = :username');
$stmt_check->bindParam(':username',$username);
$stmt_check->execute();

$data_check = $stmt_check->fetch(PDO::FETCH_OBJ);

if ($data_check){
	echo '<script language="javascript">';
	echo 'alert("USERNAME này đã được đăng kí, vui lòng chọn username khác")';
	echo '</script>';	

	header("Refresh:0; url=signup.html");
	
} 


	
else { 

	$query = 'INSERT INTO user_lit(idpeople,username,password_u,role_u,pname,email,phonenumber) VALUES (user_seq.NEXTVAL, :username ,:password,:role,:pname,:email,:phonenumber)';
	$stmt = $conn->prepare($query); // prepare
	$stmt->bindParam(':username', $username);
	$stmt->bindValue(':password', $password);
	$stmt->bindParam(':role', $role);
	$stmt->bindValue(':pname', $pname);
	$stmt->bindParam(':email', $email);
	$stmt->bindValue(':phonenumber', $phonenumber);
	$stmt->execute();
	echo '<script language="javascript">';
	echo 'alert("Đăng kí thành công, vui lòng đăng nhập để tiếp tục")';
	echo '</script>';
	header("Refresh:0; url=index.php");
	
}

?>	
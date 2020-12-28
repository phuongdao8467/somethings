<?php
session_start();
if (isset($_SESSION["isloggin"]) == false){
    echo "<script>
        alert('Bạn cần đăng nhập để mượn sách!');
        location.href= 'index.php';
        </script>";
}
?>
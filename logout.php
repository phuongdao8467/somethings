<?php
    session_start();
    session_unset();
    session_destroy();
    echo "<script>
        alert('Đăng xuất thành công!');
        location.href= 'index.php';
        </script>";
?>
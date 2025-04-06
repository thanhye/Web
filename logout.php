<?php
session_start();
session_destroy();
header("Location: index.html"); // Chuyển hướng về trang login
exit();
?>

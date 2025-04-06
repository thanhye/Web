<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Admin account (Bạn có thể thay thế bằng truy vấn database)
    if ($username === "admin" && $password === "admin123") {
        $_SESSION["user_id"] = 1;  // Giả định ID admin
        $_SESSION["username"] = "admin";
        $_SESSION["role"] = "admin";

        header("Location: admin_limit.php");
        exit();
    }

    // Nếu không phải admin
    header("Location: index.html?error=invalid");
    exit();
}
?>
<?php
session_start();
session_destroy();
header("Location: index.html");
exit();
?>

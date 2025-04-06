<?php
session_start();
require 'config.php'; // Kết nối đến cơ sở dữ liệu

$logged_in = isset($_SESSION['user_id']);
$user = null;

if ($logged_in) {
    $user_id = $_SESSION['user_id'];

    // Lấy thông tin người dùng
    $stmt = $conn->prepare("SELECT username, email, fullname FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

// Xử lý cập nhật hồ sơ
if ($_SERVER["REQUEST_METHOD"] == "POST" && $logged_in) {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);

    if (!empty($fullname) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $stmt = $conn->prepare("UPDATE users SET fullname = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $fullname, $email, $user_id);
        if ($stmt->execute()) {
            $success = "Cập nhật thành công!";
            // Cập nhật dữ liệu mới
            $user['fullname'] = $fullname;
            $user['email'] = $email;
        } else {
            $error = "Có lỗi xảy ra. Vui lòng thử lại!";
        }
    } else {
        $error = "Vui lòng nhập đúng thông tin!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ sơ cá nhân</title>
</head>
<body>
    <h2>Hồ sơ của bạn</h2>

    <?php if (!$logged_in): ?>
        <p style='color: red;'>Bạn chưa đăng nhập! Một số tính năng sẽ bị vô hiệu hóa.</p>
    <?php endif; ?>

    <?php if (isset($success)) echo "<p style='color: green;'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>

    <form method="POST">
        <label>Tên đăng nhập: </label>
        <input type="text" value="<?php echo htmlspecialchars($user['username'] ?? ''); ?>" disabled><br>

        <label>Họ và tên: </label>
        <input type="text" name="fullname" value="<?php echo htmlspecialchars($user['fullname'] ?? ''); ?>" 
               <?php echo $logged_in ? 'required' : 'disabled'; ?>><br>

        <label>Email: </label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" 
               <?php echo $logged_in ? 'required' : 'disabled'; ?>><br>

        <button type="submit" <?php echo $logged_in ? '' : 'disabled'; ?>>Cập nhật</button>
    </form>

    <a href="logout.php">Đăng xuất</a>
</body>
</html>

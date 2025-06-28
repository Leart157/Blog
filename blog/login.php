<?php
session_start();
require 'db.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $res = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($res && $res->num_rows > 0) {
        $user = $res->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: index.php");
            exit;
        }
    }
    $msg = "Invalid login!";
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Login</h2>
<form method="post">
    Username: <input name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
<p><?= $msg ?></p>
<p>No account? <a href="register.php">Register</a></p>
</body>
</html>
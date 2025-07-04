<?php
session_start();
require 'db.php';
if ($_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Admin Panel</h1>
    <p><a href="index.php">Back to Blog</a></p>
    <h2>All Users</h2>
    <?php
    $users = $conn->query("SELECT * FROM users");
    while ($user = $users->fetch_assoc()): ?>
        <p>
            <?= $user['username'] ?> (<?= $user['role'] ?>)
            <?php if ($user['id'] != $_SESSION['user_id']): ?>
                | <a href="change_role.php?id=<?= $user['id'] ?>">Toggle Role</a>
            <?php endif; ?>
        </p>
    <?php endwhile; ?>
</body>
</html>
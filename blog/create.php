<?php
session_start();
require 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $uid = $_SESSION['user_id'];
    $conn->query("INSERT INTO posts (user_id, title, content) VALUES ($uid, '$title', '$content')");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>New Post</title></head>
<body>
<h2>Create Post</h2>
<form method="post">
    Title: <input name="title" required><br>
    Content:<br><textarea name="content" required></textarea><br>
    <button type="submit">Post</button>
</form>
<p><a href="index.php">Back</a></p>
</body>
</html>
<?php
session_start();
require 'db.php';
$posts = $conn->query("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.id DESC");
?>
<!DOCTYPE html>
<html>
<head><title>Blog</title><link rel='stylesheet' href='style.css'></head>
<body>
<h1>Blog</h1>
<?php if (isset($_SESSION['user_id'])): ?>
<p><a href="create.php">New Post</a> | <a href="logout.php">Logout</a></p>
<?php else: ?>
<p><a href="login.php">Login</a> | <a href="register.php">Register</a></p>
<?php endif; ?>

<?php while ($post = $posts->fetch_assoc()): ?>
<div class='post'>
<h2><?= htmlspecialchars($post['title']) ?></h2>
<small>by <?= htmlspecialchars($post['username']) ?></small>
<p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
</div>
<?php endwhile; ?>
</body>
</html>
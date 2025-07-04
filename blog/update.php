<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$post_id = $_GET['id'] ?? null;
$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'] ?? 'user';

// Verify post exists and user has permission
$post = $conn->query("SELECT * FROM posts WHERE id = $post_id")->fetch_assoc();
if (!$post || ($post['user_id'] != $user_id && $role != 'admin')) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    // File upload handling
    $file_path = $post['file_path'];
    if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        // Delete old file if exists
        if ($file_path && file_exists($file_path)) {
            unlink($file_path);
        }
        
        $upload_dir = 'uploads/';
        $file_name = basename($_FILES['file']['name']);
        $target_path = $upload_dir . uniqid() . '_' . $file_name;
        
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
            $file_path = $target_path;
        }
    }
    
    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ?, file_path = ? WHERE id = ?");
    $stmt->bind_param("sssi", $title, $content, $file_path, $post_id);
    $stmt->execute();
    
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Post</h2>
    <form method="post" enctype="multipart/form-data">
        Title: <input name="title" value="<?= htmlspecialchars($post['title']) ?>" required><br>
        Content:<br><textarea name="content" required><?= htmlspecialchars($post['content']) ?></textarea><br>
        
        <?php if (!empty($post['file_path'])): ?>
            <p>Current file: <a href="<?= $post['file_path'] ?>" download><?= basename($post['file_path']) ?></a></p>
            <label><input type="checkbox" name="delete_file"> Delete current file</label><br>
        <?php endif; ?>
        
        New file: <input type="file" name="file"><br>
        <button type="submit">Update</button>
    </form>
    <p><a href="index.php">Cancel</a></p>
</body>
</html>
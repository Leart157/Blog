<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$post_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$conn->query("DELETE FROM posts WHERE id = $post_id AND user_id = $user_id");
header("Location: index.php");
exit;
?>

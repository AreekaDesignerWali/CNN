<?php
session_start();
include 'db.php';

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch();

if (!$article || $_SESSION['user_id'] != $article['user_id']) {
    echo "<script>alert('Access denied'); window.location.href = 'index.php';</script>";
    exit;
}

$pdo->prepare("DELETE FROM articles WHERE id = ?")->execute([$id]);
echo "<script>alert('Article deleted'); window.location.href = 'my-news.php';</script>";

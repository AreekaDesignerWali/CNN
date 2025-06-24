<?php
session_start();
include 'db.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo "<script>alert('Admin only!'); window.location.href='index.php';</script>"; exit;
}

$articles = $pdo->query("SELECT a.id, a.title, u.username FROM articles a JOIN users u ON a.user_id = u.id ORDER BY a.created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <style>
    body { font-family: Arial; padding: 2rem; background: #f4f4f4; }
    .box { background: white; padding: 1rem; margin-bottom: 1rem; border-radius: 8px; }
    h2 { color: #cc0000; }
  </style>
</head>
<body>
  <h2>Admin Dashboard</h2>
  <?php foreach ($articles as $a): ?>
    <div class="box">
      <strong><?= $a['title'] ?></strong><br>
      <small>by <?= $a['username'] ?></small>
    </div>
  <?php endforeach; ?>
</body>
</html>

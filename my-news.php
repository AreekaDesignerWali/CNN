<?php
session_start();
include 'db.php';
include 'php-errorlog.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href = 'login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM articles WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$articles = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My News - CNN Clone</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      margin: 0;
    }
    header {
      background: #cc0000;
      color: white;
      padding: 1rem;
      text-align: center;
    }
    .container {
      padding: 2rem;
    }
    .article {
      background: white;
      padding: 1rem;
      margin-bottom: 1rem;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
      cursor: pointer;
    }
    .article:hover {
      background: #fff5f5;
    }
    .no-news {
      text-align: center;
      font-size: 1.2rem;
      color: #666;
    }
  </style>
  <script>
    function goTo(url) {
      window.location.href = url;
    }
  </script>
</head>
<body>
  <header>My News</header>
  <div class="container">
    <?php if (count($articles) > 0): ?>
      <?php foreach ($articles as $article): ?>
        <div class="article" onclick="goTo('article.php?id=<?= $article['id'] ?>')">
          <h3><?= htmlspecialchars($article['title']) ?></h3>
          <p><?= substr(strip_tags($article['content']), 0, 120) ?>...</p>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="no-news">You haven't published any news yet.</div>
    <?php endif; ?>
  </div>
</body>
</html>

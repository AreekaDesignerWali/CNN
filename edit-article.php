<?php
session_start();
include 'db.php';

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch();

if (!$article || $_SESSION['user_id'] != $article['user_id']) {
    echo "<script>alert('Access denied'); window.location.href = 'index.php';</script>"; exit;
}

$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE articles SET title=?, content=?, image=?, category_id=? WHERE id=?");
    $stmt->execute([
        $_POST['title'], $_POST['content'], $_POST['image'], $_POST['category'], $id
    ]);
    $message = "Article updated successfully.";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Article</title>
  <style>
    body { font-family: Arial; padding: 2rem; background: #f4f4f4; }
    form { background: white; padding: 2rem; border-radius: 10px; max-width: 600px; margin: auto; }
    input, textarea, select, button { width: 100%; margin-bottom: 1rem; padding: 0.7rem; border-radius: 5px; }
    button { background: #cc0000; color: white; border: none; cursor: pointer; }
  </style>
</head>
<body>
  <form method="POST">
    <h2>Edit Article</h2>
    <input type="text" name="title" value="<?= htmlspecialchars($article['title']) ?>" required />
    <textarea name="content" rows="6"><?= htmlspecialchars($article['content']) ?></textarea>
    <input type="text" name="image" value="<?= $article['image'] ?>" required />
    <select name="category" required>
      <?php foreach ($categories as $cat): ?>
        <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $article['category_id'] ? 'selected' : '' ?>>
          <?= $cat['name'] ?>
        </option>
      <?php endforeach; ?>
    </select>
    <button type="submit">Update</button>
    <p><?= $message ?></p>
  </form>
</body>
</html>

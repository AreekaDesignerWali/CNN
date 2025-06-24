<?php include 'db.php'; ?>

<?php
$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo htmlspecialchars($article['title']); ?></title>
<style>
<?php include 'index.php'; // reuse same style ?>
.featured img {
    max-height: 300px;
}
</style>
</head>
<body>

<header>CNN Clone</header>

<nav>
    <a href="javascript:goTo('index.php')">Home</a>
    <a href="javascript:goTo('category.php?cat=World')">World</a>
    <a href="javascript:goTo('category.php?cat=Sports')">Sports</a>
    <a href="javascript:goTo('category.php?cat=Technology')">Technology</a>
    <a href="javascript:goTo('category.php?cat=Entertainment')">Entertainment</a>
</nav>

<div class="container">
    <div class="featured">
        <img src="uploads/<?php echo $article['image']; ?>" alt="Article">
        <h2><?php echo $article['title']; ?></h2>
        <p><?php echo $article['content']; ?></p>
    </div>
</div>

<script>
function goTo(url) {
    window.location.href = url;
}
</script>

</body>
</html>

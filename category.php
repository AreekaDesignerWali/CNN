<?php include 'db.php'; ?>

<?php
$cat = $_GET['cat'] ?? 'World';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>CNN Clone - <?php echo htmlspecialchars($cat); ?></title>
<style>
<?php include 'index.php'; // reuse same style from homepage ?>
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
    <h1><?php echo htmlspecialchars($cat); ?> News</h1>

    <div class="news-list">
        <?php
        $stmt = $pdo->prepare("SELECT * FROM news WHERE category = ?");
        $stmt->execute([$cat]);
        while($row = $stmt->fetch()):
        ?>
        <div class="news-card" onclick="goTo('article.php?id=<?php echo $row['id']; ?>')">
            <img src="uploads/<?php echo $row['image']; ?>" alt="News">
            <h3><?php echo $row['title']; ?></h3>
            <p><?php echo $row['short_desc']; ?></p>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<script>
function goTo(url) {
    window.location.href = url;
}
</script>

</body>
</html>

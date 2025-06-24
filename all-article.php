<?php
// ✅ Database connection
$host = "localhost";
$user = "uc7ggok7oyoza";
$password = "gqypavorhbbc";
$dbname = "db9emlddtcxdw2";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("❌ DB Connection Failed: " . $conn->connect_error);
}

// ✅ Fetch all articles
$sql = "SELECT title, content, created_at FROM articles ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All News Articles</title>
    <style>
        body { font-family: Arial; background: #f2f2f2; padding: 20px; }
        .article { background: white; padding: 15px; margin-bottom: 15px; border-radius: 8px; box-shadow: 0 0 5px #ccc; }
        .article h2 { margin-top: 0; }
        .date { color: #888; font-size: 12px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h1>📰 All News Articles</h1>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='article'>";
            echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
            echo "<div class='date'>Published on: " . $row['created_at'] . "</div>";
            echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No articles found.</p>";
    }

    $conn->close();
    ?>
</body>
</html>

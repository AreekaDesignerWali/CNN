<!DOCTYPE html>
<html>
<head>
    <title>Add Article</title>
</head>
<body>
    <h2>Add New Article</h2>
    <form method="POST" action="add_article.php">
        <label>Title:</label><br>
        <input type="text" name="title" required><br><br>

        <label>Content:</label><br>
        <textarea name="content" rows="5" cols="40" required></textarea><br><br>

        <input type="submit" value="Add Article">
    </form>
</body>
</html>

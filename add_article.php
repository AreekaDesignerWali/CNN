<?php
// ✅ Display all errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ✅ Database credentials
$host = "localhost"; // change if using remote DB
$user = "uc7ggok7oyoza";
$password = "gqypavorhbbc";
$dbname = "db9emlddtcxdw2";

// ✅ Create database connection
$conn = new mysqli($host, $user, $password, $dbname);

// ✅ Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// ✅ Check if POST request received
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // ✅ Sanitize inputs
    $title = isset($_POST['title']) ? $conn->real_escape_string($_POST['title']) : '';
    $content = isset($_POST['content']) ? $conn->real_escape_string($_POST['content']) : '';

    // ✅ Validate inputs
    if (empty($title) || empty($content)) {
        die("❌ Title and content are required.");
    }

    // ✅ Prepare SQL
    $sql = "INSERT INTO articles (title, content) VALUES ('$title', '$content')";

    // ✅ Execute query
    if ($conn->query($sql) === TRUE) {
        echo "✅ Article added successfully!";
    } else {
        echo "❌ Error adding article: " . $conn->error;
    }

    $conn->close();
} else {
    echo "⚠ Invalid request method.";
}
?>

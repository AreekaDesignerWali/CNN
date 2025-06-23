<?php include 'db.php'; ?>
<?php
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);

    if ($username && $email && $password) {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        try {
            $stmt->execute([$username, $email, $password]);
            $message = "Signup successful! Redirecting to homepage...";
            echo "<script>setTimeout(() => { window.location.href = 'my-news.php'; }, 2000);</script>";
        } catch (PDOException $e) {
            $message = "Error: " . $e->getMessage();
        }
    } else {
        $message = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up - CNN Clone</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
    .signup-box {
      background: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      width: 300px;
    }
    h2 {
      text-align: center;
      color: #cc0000;
    }
    input {
      width: 100%;
      padding: 0.5rem;
      margin: 0.5rem 0;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    button {
      background-color: #cc0000;
      color: white;
      border: none;
      padding: 0.7rem;
      width: 100%;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
    }
    button:hover {
      background-color: #990000;
    }
    .msg {
      margin-top: 1rem;
      text-align: center;
      color: green;
    }
  </style>
</head>
<body>
  <div class="signup-box">
    <h2>Sign Up</h2>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required />
      <input type="email" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Register</button>
    </form>
    <?php if ($message): ?>
      <div class="msg"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
  </div>
</body>
</html>

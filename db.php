<?php
session_start();
include 'db.php';
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['is_admin'];
        echo "<script>window.location.href = 'index.php';</script>";
        exit;
    } else {
        $message = "Invalid login credentials.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <style>
    body { font-family: Arial; background: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; }
    .box { background: white; padding: 2rem; border-radius: 10px; width: 300px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    input, button { width: 100%; padding: 0.7rem; margin: 0.5rem 0; border-radius: 5px; }
    button { background: #cc0000; color: white; border: none; cursor: pointer; }
  </style>
</head>
<body>
  <div class="box">
    <h2>Login</h2>
    <form method="POST">
      <input type="email" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>
    <p><?= $message ?></p>
  </div>
</body>
</html>

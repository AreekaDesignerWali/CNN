<?php
session_start();
include 'db.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo "<script>alert('Admin only!'); window.location.href='index.php';</script>";
    exit;
}
?>

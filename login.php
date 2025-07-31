<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

//prepare query to find admin by username
$stmt = $db->prepare("SELECT * FROM admins WHERE username = :username");
$stmt->bindvalue(':username', $username, SQLITE3_TEXT);
$result = $stmt->execute();
$admin = $result->fetchArray(SQLITE3_ASSOC);

if ($admin && password_verify($password, $admin['password'])) {
    //correct login
    $_SESSION['admin'] = $admin['username'];
    header("Location: dashboard.php"); //redirect to a protected app
    exit();
} else {
    //invalid login
    header("Location: login.html?error=Invalid+username+or+password");
      //echo "Invalid username or password.";
    }
}
?>
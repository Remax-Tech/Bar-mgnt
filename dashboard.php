<?php
session_start();

//redirected to login if not logged in
if (!isset($_SESSION['admin'])){
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Bar Management</title>
    <link rel="stylesheet" href="bar.css">
</head>
<body class="dash-p">
    <div class="dash-box">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['admin']); ?>!</h2>
        <p>This is your Bar Management Dashboard.</p>
        <p>You are now logged in.</p>
        
        <form action="logout.php" method="POST">
            <button type="submit">Logout</button>
        </form>
        <form action="view_drinks.php" method="POST">
            <button type="submit" style="float: right;">View Drinks</button>
        </form>
    </div>
</body>
</html>            
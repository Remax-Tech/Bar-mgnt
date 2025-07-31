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
<link rel="stylesheet" href="bar.css">
    <title>Add New Drink</title>
</head>
<body class="ad">
    <h2 style="text-align: center;">Add New Drink</h2>

    <form action="save_drink.php" method="POST" enctype="multipart/form-data">
        <lebel>Name:</lebel>
        <input type="text" name="name" required><br><br>

        <lebel>Category:</lebel>
        <select name="category" required>
            <option value="Beer">Beer</option>
            <option value="Jus">Jus</option>
            <option value="Canette">Canette</option>
            <option value="Eau">Eau</option>
            <option value="Yaourt">Yaourt</option>
        </select><br><br>
        
        <lebel>Description: (optional)</lebel>
        <textarea name="description"></textarea><br><br>

        <lebel>Price:</lebel>
        <input type="number" name="price" step="1.0" required><br><br>

        <lebel>Quantity in stock:</lebel>
        <input type="number" name="quantity" required><br><br>

        <lebel>Image filename (optional):</lebel>
        <input type="number" name="image"><br><br>

        <button type="submit">Save Drink</button>
    </form>
    
    <br>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>    